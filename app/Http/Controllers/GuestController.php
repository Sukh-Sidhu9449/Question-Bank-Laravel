<?php

namespace App\Http\Controllers;

use App\Models\Block;
use App\Models\Frameworks;
use App\Models\GroupInterviews;
use App\Models\Technologies;
use App\Models\User;
use App\Models\UserQuiz;
use Carbon\Carbon;
use Dompdf\Frame;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class GuestController extends Controller
{
    // Guest Dashboard 
    public function index()
    {
        $frameworks= Frameworks::select('id','framework_name')->get();
        return view('guest.dashboard',['frameworks'=>$frameworks]);
    }

    //Guest Register and Random Block Generation
    public function register(Request $request)  
    {
        // dd($request->all());
        $validator= Validator::make($request->all(),[
            'name' => 'required|string|min:4',
            'email' => 'required| email|max:100|unique:users',
            'framework' =>'required',   
        ]);
        // dd($validator);
        if ($validator->fails()) {
            return redirect('/guest')
                ->withErrors($validator)
                ->withInput();
        }
       $existingBlockId= $this->test($request->framework);

        if($existingBlockId){
            // dd('got it');
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt('12345');
            $user->role = 'guest';
            if ($user->save()) {
                $user_id = $user->id;
                $userQuiz = new UserQuiz;
                $userQuiz->users_id = $user_id;
                $userQuiz->block_id = $existingBlockId;
                if($userQuiz->save()){
                    $quiz_id = $userQuiz->id;
                    return redirect('/guest/quiz/'.$quiz_id.'/'.$user_id);
                }
            } else {
                return response()->json(['status' => '404']);
            }
        }else{
            // dd('no ');
            $block_id = $this->saveBlock();
            if($block_id){
                $questions = DB::table('questions as q')
                ->join('frameworks as f', 'f.id', '=', 'q.framework_id')
                ->whereIn('q.framework_id', $request->framework)
                ->select('q.id')
                ->inRandomOrder()
                ->limit(20)
                ->get();
                // dd($questions);
    
                $saveBlockQues = $this->saveBlockQuestions($questions, $block_id);
                if($saveBlockQues){
                    $user = new User;
                    $user->name = $request->name;
                    $user->email = $request->email;
                    $user->password = bcrypt('12345');
                    $user->role = 'guest';
                    if ($user->save()) {
                        $user_id = $user->id;
                        $userQuiz = new UserQuiz;
                        $userQuiz->users_id = $user_id;
                        $userQuiz->block_id = $block_id;
                        if($userQuiz->save()){
                            $quiz_id = $userQuiz->id;
                            return redirect('/guest/quiz/'.$quiz_id.'/'.$user_id);
                        }
                    } else {
                        return response()->json(['status' => '404']);
                    }
                }
            }
        }        
    }

    //Save New Random Block
    public function saveBlock()
    {
        $block = new Block;
        $block->block_name = 'random_question_'.rand(10,1000);
        $block->timer = '30';
        $block->admin_id = 1;
        $block->created_at = date('Y:m:d H:i:s');
        if($block->save()){
            return $block->id;
        }
    }

    //Save Block Questions 
    public function saveBlockQuestions($insert_data, $block_id)
    {
        $data = array();
            foreach ($insert_data as $question) {
                // dd($question);
                if ($question != "") {
                    $data[] = array(
                        'block_id' => $block_id,
                        'question_id' => $question->id, 
                    );
                }
            }
            // dd($data);
            $block_ques = DB::table('block_questions')->insert($data);
            if ($block_ques) {
                return true;
            } else {
                return false;
            }
    }

    //Fetch test for Guest User
    public function quizQuestion($quiz_id,$user_id)
    {
        $startedTime=DB::table('userquizzes')->where('id',$quiz_id)->value('started_at');
        if($startedTime==''){
            DB::table('userquizzes')->where('id',$quiz_id)->update(['started_at'=>date('Y-m-d H:i:s')]);
        }

        $query=DB::table('userquizzes')
        ->join('block_questions','block_questions.block_id','=','userquizzes.block_id')
        ->join('blocks','blocks.id','=','userquizzes.block_id')
        ->join('questions','block_questions.question_id','=','questions.id')
        ->where('userquizzes.id',$quiz_id)
        ->select('userquizzes.id as u','block_questions.block_id','block_questions.id','questions.question','blocks.timer','userquizzes.started_at')->get();
        
        $quizQuestionData = array();
        foreach($query as $key=> $userTech)
        {
            $array['u'] = $userTech->u;
            $array['block_id'] = $userTech->block_id;
            $array['timer'] = $userTech->timer;
            $array['started_at'] = $userTech->started_at;
            $array['id'] = $userTech->id;
            $array['question'] = $userTech->question;
            $array['answer'] = $this->getAnswer($userTech->u,$userTech->id);
            $array['answerid']=$this->getAnswerId($userTech->u,$userTech->id);

            $quizQuestionData[] = $array;
        }

        // print '<pre>';
        // print_r($quizQuestionData);
        // exit;
         return view("guest.guest_quiz",['quizQuestionData'=>$quizQuestionData,'userId'=>$user_id]);
    }

    //Get Answer Id 
    public function getAnswerId($quiz_id,$ques_id)
    {
        $query = DB::table('user_assessments as ua')
        ->select('ua.id')
        ->where([['ua.quiz_id',$quiz_id],['ua.block_question_id', $ques_id]])->value('id');
        return $query;

    }

    //Get Answer 
    public function getAnswer($quiz_id,$ques_id)
    {
        $query = DB::table('user_assessments as ua')
        ->select('ua.answer')
        ->where([['ua.quiz_id',$quiz_id],['ua.block_question_id', $ques_id]])->value('answer');
        return $query;
    }

    //Submit Answer
    public function insertAnswer(Request $request)
    {
        $user_id=$request->user_id;
        $data=[
            'block_question_id' => $request->question_id,
            'answer' => $request->answer,
            'users_id'=>$user_id,
            'quiz_id'=>$request->quiz_id
        ];
        DB::table('user_assessments')->insert($data);
        $id = DB::getPdo()->lastInsertId();
        return response()->json(
            [
                'id'=>$id,
                'success' => true,
                'message' => 'Data inserted successfully'
            ]
        );

    }

    //Skip Answer
    public function skipAnswer(Request $request)
    {
        // dd($request->all());
        $user_id=$request->user_id;
        $skipAnswer=[
            'block_question_id' => $request->question_id,
            'answer' => 'Skipped Answer',
            'users_id'=>$user_id,
            'quiz_id'=>$request->quiz_id
        ];
        $skip = DB::table('user_assessments')->insert($skipAnswer);
        $id = DB::getPdo()->lastInsertId();
        if($skip)
        {
        return response()->json(
            [
                'id'=>$id,
                'success' => true,
                'message' => 'Data skip successfully'
            ]
        );
         }

    }

    //Update Answer
    public function updateAnswer(Request $request){
        $last_id=$request->last;
        $data=[
                'answer' => $request->answer,
        ];

            $query=DB::table('user_assessments')->where('id',$last_id)->update($data);
            if($query){
                return response()->json(['status'=>200]);
            }

    }

    //Update Final Status of Quiz
    public function updateStatus(Request $request)
    {
        $user_id=$request->user_id;

       $date= date('Y-m-d H:i:s');
        $block_id=$request->block_id;
        $update_status=
        [
            'status'=>'S',
            'submitted_at'=>$date,
        ];
        $updateId=DB::table('userquizzes')->where([['users_id',$user_id],['block_id',$block_id]])->orderBy('id','desc')->latest()->value('id');
        $query = DB::table('userquizzes')->where('id',$updateId)->update($update_status);
        if($query)
        {
            return response()->json(['status'=>200,
                'message'=>"you have successfully submit your quiz"
        ]);
        }

    }

    public function test($frameworkId)
    {
        $blocks = Block::get('id');
        foreach($blocks as $block){
            $data = array();
            foreach($frameworkId as $frame_id){
                $questions1 = DB::table('questions as q')
                ->join('frameworks as f', 'f.id', '=', 'q.framework_id')
                ->join('block_questions as bq','q.id', '=','bq.question_id')
                ->where('bq.block_id','=',$block->id)
                ->where('q.framework_id',$frame_id)
                ->select('q.id', 'q.question')
                ->get();
                if(count($questions1) > 0){
                    $data =[...$data,...$questions1];
                }else{
                    $data = [];
                    break;
                }
            }
            if(count($data) > 0){
                return $block->id;
            }
        }
    }

    public function guestInterviewIndex($params)
    {
        $decrypt = base64_decode($params);
        // dd($decrypt);
        $userData = json_decode($decrypt,true);
        $date =Carbon::now();
        // $dateInMills = $date->timestamp;
        // $diff = $dateInMills - $userData['date'];
        $date2 = $userData['date'];
        // if($diff >= 172800000){
        if($date->gte($date2)){
            $groupInterview = GroupInterviews::find($userData['groupInterviewId']);
            $groupData = $groupInterview->group_users;
            $decodedGroupData = json_decode($groupData,true);
            foreach ($decodedGroupData as $key=>$group) {
                if($group['email'] == $userData['userEmail']){
                    $userIndex = $key;
                }
            }
            $decodedGroupData[$userIndex]['interviewStatus'] = "Expired";
            $jsonData = json_encode($decodedGroupData);
            $groupInterview->group_users = $jsonData;
            $groupInterview->save();
            return view('guest.guest_expiry_link'); 
        }else{
            // dd('active');
            return view('guest.register',$userData);
        }        
    }

    public function guestRegister(Request $request)
    {
        // dd($request->all());
        $validator= Validator::make($request->all(),[
            'name' => 'required|string|min:4',
            'email' => 'required|email|max:100|unique:users',
            'designation' => 'required|string',
            'experience' => 'required|numeric|between:0,99.99',
            'phone_number' => 'required|numeric|digits:10',
        ]);
        $groupInterview = GroupInterviews::find($request->groupInterviewId);
        $groupData = $groupInterview->group_users;
        $decodedGroupData = json_decode($groupData,true);
        foreach ($decodedGroupData as $key=>$group) {
            if($group['email'] == $request->email){
                $userIndex = $key;
            }
        }
        
        // dd($decodedGroupData[$userIndex]);
        $existingUser = User::where('email',$request->email)->first();
        if($existingUser){
            // dd($existingUser->id);
            $user_id = $existingUser->id;
            $userQuiz = new UserQuiz;
            $userQuiz->users_id = $user_id;
            $userQuiz->block_id = $groupInterview->block_id;
            if($userQuiz->save()){
                $quiz_id = $userQuiz->id;
                $decodedGroupData[$userIndex]['id'] = $existingUser->id;
                $decodedGroupData[$userIndex]['name'] = $existingUser->name;
                $decodedGroupData[$userIndex]['interviewStatus'] = "Accepted";
                $decodedGroupData[$userIndex]['quizId'] = $userQuiz->id;
                $jsonData = json_encode($decodedGroupData);
                $groupInterview->group_users = $jsonData;
                $groupInterview->save();
                return redirect('/guest/video/'.$quiz_id);
            }
        }
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->designation =$request->designation;
        $user->experience =$request->experience;
        $user->phone_number =$request->phone_number;
        $user->password = bcrypt('12345');
        $user->role = 'guest';
        if ($user->save()) {
            $user_id = $user->id;
            $userQuiz = new UserQuiz;
            $userQuiz->users_id = $user_id;
            $userQuiz->block_id = $groupInterview->block_id;
            if($userQuiz->save()){
                $quiz_id = $userQuiz->id;
                $decodedGroupData[$userIndex]['id'] = $user->id;
                $decodedGroupData[$userIndex]['name'] = $user->name;
                $decodedGroupData[$userIndex]['interviewStatus'] = "Accepted";
                $decodedGroupData[$userIndex]['quizId'] = $userQuiz->id;
                $jsonData = json_encode($decodedGroupData);
                $groupInterview->group_users = $jsonData;
                $groupInterview->save();
                return redirect('/guest/video/'.$quiz_id);
            }
        } else {
            return response()->json(['status' => '404']);
        }
    }
    
    public function videoIndex($quizId)
    {
        $userQuiz = UserQuiz::find($quizId);
        $user = User::find($userQuiz->users_id);
        $block = Block::find($userQuiz->block_id);
        // dd($block);
        $mandateSkillArray = explode(',',$block->mandatory_skills);
        $opSkillArray = explode(',',$block->optional_skills);
        $mandatorySkills = Frameworks::select('framework_name as mandatory_technology')->whereIn('id',$mandateSkillArray)->get();
        $optionalSkills = Frameworks::select('framework_name as optional_technology')->whereIn('id',$opSkillArray)->get();
        // dd($mandatorySkills);
        $mandatorySkills = json_encode($mandatorySkills);
        $optionalSkills = json_encode($optionalSkills);

        // dd($mandatorySkills);
        return view('guest.video',['quizId'=>$quizId,'username'=>$user->name,'mandatorySkills'=>$mandatorySkills,'optionalSkills'=>$optionalSkills]);
    }
}
