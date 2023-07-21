<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\BotInterviews;
use App\Models\Frameworks;
use App\Models\User;
use App\Models\UserQuiz;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Pdf;
use Mail;


use Illuminate\Support\Facades\DB;

class BotInterviewController extends Controller
{
    public function storeInterviewData(Request $request)
    {
        try {
        //    dd($request->all());
            $validator = Validator::make($request->all(), [
                'quizId' => 'required',
                'interviewData' => 'required',
                'userInput' => 'required',
            ]);
            if ($validator->fails()) {
                $response = [
                    'message' => $validator->errors()
                ];
                return response()->json($response, 409);
            }
            $user = UserQuiz::where('id', $request->quizId)->value('users_id');
            // dd($user); 
            $BotData = new BotInterviews;
            $BotData->quiz_id = $request->quizId;
            $BotData->users_id = $user;
            $BotData->interview_data = $request->interviewData;
            $BotData->user_input = $request->userInput;
            $BotData->save();
            $id = $BotData->id;
            $date = $BotData->created_at;
            $userInterview = UserQuiz::find($request->quizId);
            $userInterview->status = "AR";
            $userInterview->save();
            $mail = $this->sendMail($request->interviewData, $user, $date,$request->userInput);
            // dd($mail);
            $this->updateJsonData($request->interviewData, $id);
            $this->updateGlobalAvg($request->interviewData);
        } catch (QueryException $ex) {
            return response()->json(['message' => $ex->getMessage()], 404);
        }
        return response()->json([$BotData], 200);
    }

    public function sendMail($jsonInterviewData = null, $user, $date,$userInput = null)
    {
        $userInfo = User::find($user);
        $userData = [
            'name' => $userInfo->name,
            'email' => $userInfo->email,
            'designation' => $userInfo->designation,
            'experience' => $userInfo->experience,
            'phoneNumber' => $userInfo->phone_number,
            'submittedAt' => $date,
        ];

        $decodeUserInput = json_decode($userInput,true);

        $charts = $this->chart($quizId = null, $jsonInterviewData, $userInput);
        //    dd($charts);

        $pdf = Pdf::loadView('PDF.chartPDF', ['charts' => $charts, 'userData' => $userData,'userInput'=>$decodeUserInput])
            ->setPaper('a4', 'portrait');
        // dd($pdf);
        $data = [
            'email' => '',
            'subject' => 'Interview Result',
        ];
        // $charts['msg']="PDF attachments";
        // return $pdf->stream();
        $mail = Mail::send('emails.pdfEmail', $userData, function ($message) use ($data, $pdf) {
            $message->from('abc@yopmail.com', env('App_NAME'));
            $message->to('sukh534@yopmail.com');
            $message->subject($data['subject']);
            $message->attachData($pdf->output(), "Interview-Result.pdf");
        });
        return $mail;
    }

    public function chart($quizId = null, $jsonInterviewData = null,$userInput = null)
    {
        $videoProcessArray = [];
        $videoProcessScore = [];
        $videoProcessDataArray = [];
        $mandateTechArray = [];
        $mandateTechScore = [];
        $mandateTechDataArray = [];
        $opTechArray = [];
        $opTechScore = [];
        $opTechDataArray = [];
        $topTechDataArray =  [];
        $setJsonData = false;
        // $arrayData = ['overall_score' => 30,'individual_score'=>['HTML'=>20,'PHP'=>40,'Laravel'=>30]];
        if ($jsonInterviewData == null) {
            $setJsonData = true;
            $BotInterviews = BotInterviews::where('quiz_id', $quizId)->orderBy('id', 'desc')->first();
            $jsonInterviewData = $BotInterviews->interview_data;
            $userInput = $BotInterviews->user_input;
            // $jsonInterviewData = '{"overall_score":40,"individual_score":{"MySQL":20,"Core Php":40,"Laravel":30}}';
        }
        $decodeUserInput = json_decode($userInput,true);
        // dd($decodeUserInput);
        $arrayData = json_decode($jsonInterviewData, true);
        // dd($arrayData['text_processing_result']['individual_score']);
        // $arrayData['text_processing_result']
        // $arrayData['video_processing_result']

        foreach ($arrayData['video_processing_result']['result'] as $key => $value) {
            $videoProcessArray = [...$videoProcessArray, $key];
            $videoProcessScore = [...$videoProcessScore, $value];
            $videoProcessChart = $this->doughnutChart($value);
            $videoProcessDataArray = [...$videoProcessDataArray, $videoProcessChart];
        }
        $videoProcessData = ['videoProcessArray'=>$videoProcessArray,'videoProcessScore'=>$videoProcessScore, 'videoProcessChart' =>$videoProcessDataArray];
        // dd($videoProcessData);
        $overall_score = $arrayData['text_processing_result']['overall_score'];
        $individual_score = $arrayData['text_processing_result']['individual_score'];
        // dd($individual_score['optional_skills']);
        // dd($individual_score['mandatory_skills']);
        $topChartCount = 0;
        foreach ($individual_score['mandatory_skills'] as $key => $value) {
            // $doc = $loop->iteration ;
            $mandateTechArray = [...$mandateTechArray, $key];
            $mandateTechScore = [...$mandateTechScore, $value];
            $mandateTechChart = $this->doughnutChart($value);
            if($topChartCount< 3){
                $topTechChart = $this->mainDoughnutChart($value, $key);
                $topTechDataArray = [...$topTechDataArray, $topTechChart];
                $topChartCount++;
            }
            $mandateTechDataArray = [...$mandateTechDataArray, $mandateTechChart];
        }
        $mandatoryData = ['mandatoryTechnology'=>$mandateTechArray,'mandatoryScore'=>$mandateTechScore, 'mandatoryChart' =>$mandateTechDataArray];
        // dd($topTechDataArray);
        foreach ($individual_score['optional_skills'] as $key => $value) {
            $opTechArray = [...$opTechArray, $key];
            $opTechScore = [...$opTechScore, $value];
            $opTechChart = $this->doughnutChart($value);
            $opTechDataArray = [...$opTechDataArray, $opTechChart];
        }
        $optionalData = ['optionalTechnology'=>$opTechArray,'optionalScore'=>$opTechScore, 'optionalChart' =>$opTechDataArray];
        $avg_global_score = null;
        if (array_key_exists('avg_global_score', $arrayData)) {
            $avg_global_score = $arrayData['avg_global_score'];
        }
        $bar = $this->barChart($mandateTechArray, $mandateTechScore, $avg_global_score);
        $doughnut = $this->doughnutChart($overall_score);
        if ($setJsonData) {
            $charts = ['mainChart' => [$doughnut, $bar], 'topTechChart' => $topTechDataArray, 'mandatoryData' => $mandatoryData, 'optionalData' => $optionalData,'videoProcessData'=>$videoProcessData];
            //      return view('PDF.chartPDF', [
            //         'charts'=>$charts,
            // ]);
            $pdf = Pdf::loadView('PDF.chartPDF', ['charts' => $charts,'userInput'=>$decodeUserInput])
                ->setPaper('a4', 'portrait');
            return $pdf->stream();
        }
        return ['mainChart' => [$doughnut, $bar], 'topTechChart' => $topTechDataArray, 'mandatoryData' => $mandatoryData, 'optionalData' => $optionalData,'videoProcessData'=>$videoProcessData];
    }

    public function doughnutChart($arg)
    { 
        $opData = [];
        $background = ['rgb(211, 211, 211)'];
        $data = [$arg];
        foreach ($data as  $value) {
            // $opData = [...$opData,$value.'%']; 
            if ($value == 0) {
                $val = 100;
                $value = 0;
            } else {
                $val = 100 - $value;
            }
            $opData = [$value, $val];
            if ($value <= 30) {
                array_unshift($background, 'rgb(247, 79, 79)');
            } elseif ($value > 30  && $value <= 50) {
                array_unshift($background, 'rgb(235, 177, 54)');
            } elseif ($value > 50  && $value < 70) {
                array_unshift($background, 'rgb(54, 162, 235)');
            } else {
                array_unshift($background, 'rgb(58, 201, 87)');
            }
        }
        $chartData = [
            'type' => 'doughnut',
            'data' => [
                'datasets' => [
                    [
                        'data' => $opData,
                        'backgroundColor' => $background,
                    ],
                ],
                // 'labels'=> ['Red', 'Orange', 'Yellow', 'Green', 'Blue'],
            ],
            'options' => [
                'plugins' => [
                    'datalabels' => [
                        'display' => false,
                    ],
                    'doughnutlabel' => [
                        'labels' => [
                            [
                                'text' => $data,
                                'font' => [
                                    'size' => 20,
                                    'weight' => 'bold',
                                ],
                            ],
                            [
                                'text' => 'Score',
                            ],
                        ],
                    ],
                ],
            ],
        ];
        $chart = json_encode($chartData);
        return $chart;
    }

    public function mainDoughnutChart($arg, $names)
    {
        $opData = [];
        $background = ['rgb(211, 211, 211)'];
        $data = [$arg];
        foreach ($data as  $value) {
            // $opData = [...$opData,$value.'%']; 
            if ($value == 0) {
                $val = 100;
                $value = 0;
            } else {
                $val = 100 - $value;
            }
            $opData = [$value, $val];
            if ($value <= 30) {
                array_unshift($background, 'rgb(247, 79, 79)');
            } elseif ($value > 30  && $value <= 50) {
                array_unshift($background, 'rgb(235, 177, 54)');
            } elseif ($value > 50  && $value < 70) {
                array_unshift($background, 'rgb(54, 162, 235)');
            } else {
                array_unshift($background, 'rgb(58, 201, 87)');
            }
        }
        $chartData = [
            'type' => 'doughnut',
            // 'radius' => "100%", 
            'innerRadius' => "90%",
            'data' => [
                'datasets' => [
                    [
                        'data' => $opData,
                        'backgroundColor' => $background,
                    ],
                ],
                // 'labels'=> ['Red', 'Orange', 'Yellow', 'Green', 'Blue'],
            ],
            'options' => [
                'plugins' => [
                    'datalabels' => [
                        'display' => false,
                    ],
                    'doughnutlabel' => [
                        'labels' => [
                            [
                                'text' => $names,
                                'font' => [
                                    'size' => 14,
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];
        $chart = json_encode($chartData);
        return $chart;
    }

    public function barChart($tech, $userScore, $avg_global_score = null)
    {
        $userSkills = $tech;
        if ($avg_global_score == null) {
            $avg_global_score = [];
            foreach ($tech as $t) {
                $selects = Frameworks::select('avg_global_score', 'framework_name', 'total_interviews')->where('framework_name', $t)->first();
                $avg_global = $selects->avg_global_score;
                $avg_global_score = [...$avg_global_score, $avg_global];
            }
        }
        $userSkillScore = $userScore;
        $chartData =
            [
                'type' => 'bar',
                'data' => [
                    'labels' => $userSkills,
                    'datasets' => [
                        ['label' => 'Avg. Global Skills', 'data' => $avg_global_score],
                        ['label' => 'Candidate Skills', 'data' => $userSkillScore],
                    ],
                ],
            ];
        $chart = json_encode($chartData);
        return $chart;

        // $pdf =   Pdf::loadView('welcome',['chart'=>$chart])
        // ->setPaper('a4', 'portrait');
        // return $pdf->download('chart.pdf');
    }

    public function updateGlobalAvg($userData)
    {
        $arrayData = json_decode($userData, true);
        $overall_score = $arrayData['text_processing_result']['overall_score'];
        $individual_score = $arrayData['text_processing_result']['individual_score'];
        foreach ($individual_score['mandatory_skills'] as $key => $value) {
            $avgPerTech = Frameworks::where("framework_name", $key)->select('id', 'avg_global_score', 'total_interviews')->first();
            $updatedInterviewCount = (int)($avgPerTech->total_interviews) + 1;
            $totalAvgGlobal = (int)($avgPerTech->avg_global_score) * (int)($avgPerTech->total_interviews);
            $updateData = (int)(($totalAvgGlobal + (int)($value)) / $updatedInterviewCount);
            $framework = Frameworks::find($avgPerTech->id);
            $framework->avg_global_score = $updateData;
            $framework->total_interviews = $updatedInterviewCount;
            $framework->save();
        }
        return true;
    }

    public function updateJsonData($jsonData, $id)
    {
        $techAvgData = [];
        $arr = json_decode($jsonData, true);
        $individual_score = $arr['text_processing_result']['individual_score'];
        foreach ($individual_score['mandatory_skills'] as $key => $value) {
            $avgGlobalScore = Frameworks::where("framework_name", $key)->select('avg_global_score')->limit(1)->value('avg_global_score');
            $techAvgData = [...$techAvgData, $avgGlobalScore];
        }
        $arr = [...$arr, 'avg_global_score' => $techAvgData];
        $newJson = json_encode($arr);
        $botInterview = BotInterviews::find($id);
        $botInterview->interview_data = $newJson;
        $botInterview->save();
        return true;
    }
}
