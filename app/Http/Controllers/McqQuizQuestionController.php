<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class McqQuizQuestionController extends Controller
{
    public function insertMcq(Request $request){
        $userid = Auth::user()->id;
        $data=[
        'users_id' => $userid,
        'quiz_id' => $request->mcqQuizId,
        'block_question_id' => $request->mcqBlockQuestionId,
        'answer' => $request->insertedmcq,
        'marks_per_ques' => $request->marksPerQues
        ];
        $query = DB::table('user_assessments')->insert($data);
        if(!$query){
            return response()->json(['status'=>404]);
        }else{
            return response()->json(['status'=>200]);
        }
    }

    public function updateMcqStatus(Request $request)
    {
       $date= date('Y-m-d H:i:s');
        $mcqQuizId=$request->mcqQuizId;
        $mcqAggregate = $request->mcqAggregate;
        $update_status=
        [
            'status'=>'C',
            'submitted_at'=>$date,
            'block_aggregate'=>$mcqAggregate
        ];
        // $updateId=DB::table('userquizzes')->where([['users_id',$user_id],['block_id',$block_id]])->orderBy('id','desc')->latest()->value('id');
        $query = DB::table('userquizzes')->where('id',$mcqQuizId)->update($update_status);
        if($query)
        {
            return response()->json(['status'=>200,
                'message'=>"you have successfully submit your quiz"
        ]);
        }
    }
}
