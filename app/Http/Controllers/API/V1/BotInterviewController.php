<?php

namespace App\Http\Controllers\Api\V1;
use App\Http\Controllers\Controller;
use App\Models\BotInterviews;
use App\Models\Frameworks;
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
            $validator = Validator::make($request->all(),[
                'quizId' => 'required',
                'interviewData' => 'required',    
            ]);
            if($validator->fails()){
                $response = [
                    'message' => $validator->errors()
                ];
                return response()->json($response,409);
            }

            $user = UserQuiz::find($request->quizId)->value('users_id');  
            $BotData = new BotInterviews;
            $BotData->quiz_id = $request->quizId;
            $BotData->users_id = $user;
            $BotData->interview_data = $request->interviewData;
            $BotData->save();
            $id = $BotData->id;
            $this->sendMail($request->interviewData);
            $this->updateJsonData($request->interviewData,$id);
            $this->updateGlobalAvg($request->interviewData);
        } catch (QueryException $ex) {
            return response()->json(['message' => $ex->getMessage()], 404);
        }
        return response()->json([$BotData],200);
    }

    public function sendMail($jsonInterviewData = null)
    {
       $charts = $this->chart($jsonInterviewData);
    //    dd($charts['mainChart']);

        $pdf = Pdf::loadView('PDF.chartPDF',$charts)
        ->setPaper('a4', 'portrait');
        // dd($pdf);
        $data = [
            'email'=> '',
            'subject' => 'Something',
        ];
        $charts['msg']="PDF attachments";
        // return $pdf->stream();
        Mail::send('emails.viewEmail',$charts, function($message)use($data, $pdf) {
            $message->from('abc@yopmail.com', env('App_NAME'));
            $message->to('sukh534@yopmail.com');
            $message ->subject($data['subject']);
            $message->attachData($pdf->output(), "Interview-Result.pdf");
        });
    }

    public function chart($jsonInterviewData = null,$quizId = null)
    {
        $techArray = [];
        $techScore = [];
        $techDataArray = [];
        $setJsonData = false;
        // $arrayData = ['overall_score' => 30,'individual_score'=>['HTML'=>20,'PHP'=>40,'Laravel'=>30]];
        if($jsonInterviewData == null){
            $setJsonData = true;
            $BotInterviews = BotInterviews::where('quiz_id',2)->orderBy('id','desc')->first();
            $jsonInterviewData = $BotInterviews->interview_data;
            // dd($jsonInterviewData);
            // $jsonInterviewData = '{"overall_score":40,"individual_score":{"MySQL":20,"Core Php":40,"Laravel":30}}';
        }
        $arrayData = json_decode($jsonInterviewData,true);
        $overall_score = $arrayData['overall_score'];
        $individual_score = $arrayData['individual_score'];
        foreach($individual_score as $key => $value){
            $techArray = [...$techArray, $key];
            $techScore = [...$techScore, $value];
            $techChart = $this->doughnutChart($value);
            $techDataArray = [...$techDataArray, $techChart];
        }
        $avg_global_score = null;
        if(array_key_exists('avg_global_score', $arrayData)){
            $avg_global_score = $arrayData['avg_global_score'];
        }
        // dd($avg_global_score);
        $bar = $this->barChart($techArray, $techScore,$avg_global_score);
        $doughnut = $this->doughnutChart($overall_score);
        // return view('chartPDF', [
        //     'chart' => [$doughnut,$bar],
        // ]);
        if($setJsonData){
            $pdf = Pdf::loadView('PDF.chartPDF', ['mainChart' => [$doughnut, $bar], 'techChart' => $techDataArray])
                ->setPaper('a4', 'portrait');
            return $pdf->stream();
        }
        return ['mainChart' => [$doughnut, $bar], 'techChart' => $techDataArray];
    }

    public function doughnutChart($arg)
    {
        $opData = [];
        $background = ['rgb(211, 211, 211)'];
        $data = [$arg];
        foreach ($data as  $value) {
            // $opData = [...$opData,$value.'%']; 
            $val = 100 - $value;
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

    public function barChart($tech, $userScore, $avg_global_score = null)
    {
        $userSkills = $tech;
        if($avg_global_score == null){
            $avg_global_score = [];
            foreach($tech as $t){
                $selects = Frameworks::select('avg_global_score','framework_name','total_interviews')->where('framework_name',$t)->first();
                $avg_global = $selects->avg_global_score;
                $avg_global_score = [...$avg_global_score,$avg_global];
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
        $arrayData = json_decode($userData);
        $overall_score=$arrayData->overall_score;
        $individual_score =$arrayData->individual_score;
        foreach($individual_score as $key => $value){
            $avgPerTech = Frameworks::where("framework_name", $key)->select('id','avg_global_score','total_interviews')->first();
            $updatedInterviewCount =(int)($avgPerTech->total_interviews) + 1;
            $updateData = (int)(((int)($avgPerTech->avg_global_score) + (int)($value))/$updatedInterviewCount);
            $framework = Frameworks::find($avgPerTech->id);
            $framework->avg_global_score = $updateData;
            $framework->total_interviews = $updatedInterviewCount;
            $framework->save();
        }
        return true;
    }

    public function updateJsonData($jsonData,$id)   
    {
        $techAvgData = [];
        $arr = json_decode($jsonData,true);
        $individual_score =$arr['individual_score'];
        foreach($individual_score as $key => $value){
            $avgGlobalScore = Frameworks::where("framework_name", $key)->select('avg_global_score')->limit(1)->value('avg_global_score');
            $techAvgData = [...$techAvgData, $avgGlobalScore];
        }
        $arr = [...$arr,'avg_global_score'=>$techAvgData];
        $newJson = json_encode($arr);
        $botInterview = BotInterviews::find($id);
        $botInterview->interview_data = $newJson;
        $botInterview->save();
        return true;
    }   
}
