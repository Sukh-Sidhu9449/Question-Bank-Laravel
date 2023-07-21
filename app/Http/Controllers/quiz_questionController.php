<?php

namespace App\Http\Controllers;

use App\Models\Block;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use app\Models\Datamodel;
use App\Models\Frameworks;
use App\Models\User;
use App\Models\UserQuiz;
use \Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

date_default_timezone_set("Asia/Calcutta");



class quiz_questionController extends Controller
{
    public function mcqQuizQuestion($quiz_id, $u_id)
    {
        $startedTime = DB::table('userquizzes')->where('id', $quiz_id)->value('started_at');
        if ($startedTime == '') {
            DB::table('userquizzes')->where('id', $quiz_id)->update(['started_at' => date('Y-m-d H:i:s')]);
        }

        $technologies = DB::table('technologies')->whereBetween('id', [1, 10])->get();

        $query = DB::table('userquizzes')
            ->join('block_questions', 'block_questions.block_id', '=', 'userquizzes.block_id')
            ->join('blocks', 'blocks.id', '=', 'userquizzes.block_id')
            ->join('mcq_questions', 'block_questions.question_id', '=', 'mcq_questions.id')
            ->where('userquizzes.id', $quiz_id)
            ->select('userquizzes.id as quizId', 'block_questions.block_id', 'block_questions.id as blockQuestionId', 'mcq_questions.mcq_questions as question', 'mcq_questions.id as questionId', 'blocks.timer', 'userquizzes.started_at')
            ->get();

        $quizQuestionData = array();
        foreach ($query as $key => $userTech) {
            $array['quizId'] = $userTech->quizId;
            $array['blockId'] = $userTech->block_id;
            $array['timer'] = $userTech->timer;
            $array['startedAt'] = $userTech->started_at;
            $array['blockQuestionId'] = $userTech->blockQuestionId;
            $array['question'] = $userTech->question;
            $array['answer'] = $this->getMcqAnswer($userTech->questionId);
            $array['correctAnswer'] = $this->getCorrectAnswer($userTech->questionId);

            $quizQuestionData[] = $array;
        }

        //         print '<pre>';
        //         print_r($quizQuestionData);
        //         exit;
        return view('user.mcqQuiz', ['quizQuestionData' => $quizQuestionData, 'technologies' => $technologies]);
    }

    public function getMcqAnswer($questionId)
    {
        $query = DB::table('mcq_answers')
            ->select('mcq_answers')
            ->where('mcq_question_id', $questionId)->get();
        return $query;
    }
    public function getCorrectAnswer($questionId)
    {
        $query = DB::table('mcq_answers')
            ->select('mcq_answers')
            ->where([['mcq_question_id', $questionId], ['status', '=', 1]])->value('mcq_answers');

        return $query;
    }

    public function quizQuestion($quiz_id, $u_id)
    {
        $startedTime = DB::table('userquizzes')->where('id', $quiz_id)->value('started_at');
        if ($startedTime == '') {
            DB::table('userquizzes')->where('id', $quiz_id)->update(['started_at' => date('Y-m-d H:i:s')]);
        }


        $technologies = DB::table('technologies')->whereBetween('id', [1, 10])->get();

        $query = DB::table('userquizzes')
            ->join('block_questions', 'block_questions.block_id', '=', 'userquizzes.block_id')
            ->join('blocks', 'blocks.id', '=', 'userquizzes.block_id')
            ->join('questions', 'block_questions.question_id', '=', 'questions.id')
            ->where('userquizzes.id', $quiz_id)
            ->select('userquizzes.id as u', 'block_questions.block_id', 'block_questions.id', 'questions.question', 'blocks.timer', 'userquizzes.started_at')->get();

        $quizQuestionData = array();
        foreach ($query as $key => $userTech) {
            $array['u'] = $userTech->u;
            $array['block_id'] = $userTech->block_id;
            $array['timer'] = $userTech->timer;
            $array['started_at'] = $userTech->started_at;
            $array['id'] = $userTech->id;
            $array['question'] = $userTech->question;
            $array['answer'] = $this->getAnswer($userTech->u, $userTech->id);
            $array['answerid'] = $this->getAnswerId($userTech->u, $userTech->id);

            $quizQuestionData[] = $array;
        }

        // print '<pre>';
        // print_r($quizQuestionData);
        // exit;
        return view("user.quiz_question", ['quizQuestionData' => $quizQuestionData, 'technologies' => $technologies]);
    }

    public function getAnswerId($quiz_id, $ques_id)
    {
        $query = DB::table('user_assessments as ua')
            ->select('ua.id')
            ->where([['ua.quiz_id', $quiz_id], ['ua.block_question_id', $ques_id]])->value('id');
        return $query;
    }
    public function getAnswer($quiz_id, $ques_id)
    {
        $query = DB::table('user_assessments as ua')
            ->select('ua.answer')
            ->where([['ua.quiz_id', $quiz_id], ['ua.block_question_id', $ques_id]])->value('answer');
        return $query;
    }
    public function insertAnswer(Request $request)
    {

        $user_id = Auth::user()->id;
        $data = [
            'block_question_id' => $request->question_id,
            'answer' => $request->answer,
            'users_id' => $user_id,
            'quiz_id' => $request->quiz_id
        ];
        DB::table('user_assessments')->insert($data);
        $id = DB::getPdo()->lastInsertId();
        return response()->json(
            [
                'id' => $id,
                'success' => true,
                'message' => 'Data inserted successfully'
            ]
        );
    }
    public function skipAnswer(Request $request)
    {
        $user_id = Auth::user()->id;
        $skipAnswer = [
            'block_question_id' => $request->question_id,
            'answer' => 'Skipped Answer',
            'users_id' => $user_id,
            'quiz_id' => $request->quiz_id
        ];
        $skip = DB::table('user_assessments')->insert($skipAnswer);
        $id = DB::getPdo()->lastInsertId();
        if ($skip) {
            return response()->json(
                [
                    'id' => $id,
                    'success' => true,
                    'message' => 'Data skip successfully'
                ]
            );
        }
    }
    public function updateAnswer(Request $request)
    {
        $last_id = $request->last;
        $data = [
            'answer' => $request->answer,
        ];

        $query = DB::table('user_assessments')->where('id', $last_id)->update($data);
        if ($query) {
            return response()->json(['status' => 200]);
        }
    }
    public function updateStatus(Request $request)
    {
        $user_id = Auth::user()->id;
        $date = date('Y-m-d H:i:s');
        $block_id = $request->block_id;
        $update_status =
            [
                'status' => 'S',
                'submitted_at' => $date,
            ];
        $updateId = DB::table('userquizzes')->where([['users_id', $user_id], ['block_id', $block_id]])->orderBy('id', 'desc')->latest()->value('id');
        $query = DB::table('userquizzes')->where('id', $updateId)->update($update_status);
        if ($query) {
            return response()->json([
                'status' => 200,
                'message' => "you have successfully submit your quiz"
            ]);
        }
    }
    public function statusInitiate()
    {
        return response()->json(['status' => 200]);
    }

    public function videoIndex($quizId)
    {
        // dd($quizId);
        $userQuiz = UserQuiz::find($quizId);
        $block = Block::find($userQuiz->block_id);
        // dd($block);
        $mandateSkillArray = explode(',', $block->mandatory_skills);
        $opSkillArray = explode(',', $block->optional_skills);
        $mandatorySkills = Frameworks::select('framework_name as mandatory_technology')->whereIn('id', $mandateSkillArray)->get();
        $optionalSkills = Frameworks::select('framework_name as optional_technology')->whereIn('id', $opSkillArray)->get();
        // dd($mandatorySkills);
        $mandatorySkills = json_encode($mandatorySkills);
        $optionalSkills = json_encode($optionalSkills);
        return view("video", ['quizId' => $quizId, 'mandatorySkills' => $mandatorySkills, 'optionalSkills' => $optionalSkills]);
    }

    public function getChatbotQuiz(Request $request)
    {
        $quiz_id = $request->quiz_id;
        $query = DB::table('userquizzes')
            ->join('block_questions', 'block_questions.block_id', '=', 'userquizzes.block_id')
            ->join('blocks', 'blocks.id', '=', 'userquizzes.block_id')
            ->join('questions', 'block_questions.question_id', '=', 'questions.id')
            ->join('answers', 'answers.question_id', '=', 'questions.id')
            ->join('frameworks', 'frameworks.id', '=', 'questions.framework_id')
            ->where('userquizzes.id', $quiz_id)
            ->select('userquizzes.id as quiz_id', 'answers.answer', 'block_questions.id', 'questions.question', "frameworks.framework_name as technology")->get();
        return response()->json($query);
    }

    public function saveVideoData(Request $request)
    {
        $store = Storage::disk('public')->put('attempt3.txt', $request->blob);
        $target_url = 'http://10.8.14.83:9099/upload/'; // Write your URL here
        $dir = 'C:\wamp64\www\Question-bank 28-10-2022 New\Question-bank\public\storage\attempt3.txt'; // full directory of the file
        // $response = Http::attach(
        //     'attachment', $dir, 'attempt3.txt'
        // )->post($target_url);

        $cFile = curl_file_create($dir);
        $post = array('blob' => $cFile, 'file' => $request->file, 'quiz_id' => $request->quiz_id, 'Optional' => $request->Optional, 'Mandatory' => $request->Mandatory); // Parameter to be sent
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $target_url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
       
        $result = curl_exec($ch);
        curl_close($ch);
        if (curl_errno($ch)) {
            $error_msg = curl_error($ch);
        }
        curl_close($ch);
        
        if (isset($error_msg)) {
            // TODO - Handle cURL error accordingly
        return response()->json($error_msg,404);
        }
        return response()->json(json_decode($result),200);
        //  dd(json_decode($result));
                    // print '<pre>';
        // print_r($result);
        // dd($request->all());
        // exit;
        
        // if ($result) {
        //     // dd(json_encode($result));
        //     $post2 = array('interviewData' =>"String", 'userInput' => $request->userInput, 'quizId' => $request->quiz_id); // Parameter to be sent
        //    // $post2 = array('interviewData' => json_encode($result), 'userInput' => $request->userInput, 'quizId' => $request->quiz_id); // Parameter to be sent
        //     $target_url2 = 'http://127.0.0.1:8000/api/v1/interview-data'; // Write your URL here
        //     // $postvars = '';
        //     // foreach ($post2 as $key => $value) {
        //     //     $postvars .= $key . "=" . $value . "&";
        //     // }
            
        //     $ch2 = curl_init();
        //     curl_setopt($ch2, CURLOPT_URL, $target_url2);
        //     curl_setopt($ch2, CURLOPT_POST, 1);
        //     curl_setopt($ch2, CURLOPT_POSTFIELDS, $post2);
        //     curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);

        //     // dd($ch2);
        //     $result2 = curl_exec($ch2);
        //     dd($result2);
        //     if (curl_errno($ch2)) {
        //         $error_msg = curl_error($ch2);
        //     }
        //     curl_close($ch2);
        //     if (isset($error_msg)) {
        //     dd($error_msg);

        //         // TODO - Handle cURL error accordingly
        //     }
        //     dd($result2);
        // }
        return view("video");
    }
}
