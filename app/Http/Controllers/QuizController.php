<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuizController extends Controller
{
    public function index(){
        $technologies=DB::table('technologies')->get();
        return view('admin.quiz',['technologies'=>$technologies]);
    }
    public function getquestions(Request $request)
    {
        $tech_id=$request->tech_id;
        $frame_id=$request->frame_id;
        $id=$request->exp_id;
        $limit=$request->limit;
        $quiz_count=$request->quiz_count;
        if($quiz_count==0){
            $offset=0;
        }else{
            $offset=$quiz_count*$limit;
            // dd($limit);
        }
        if($id==0){
            $questions=DB::table('questions')->where([
                ['technology_id',$tech_id],
                ['framework_id',$frame_id]
            ]);
        }else{
            $questions=DB::table('questions')->where([
                ['technology_id',$tech_id],
                ['framework_id',$frame_id],
                ['experience_id',$id]
            ]);
        }
        $questions= $questions->offset($offset)->limit($limit)->get();
        if(count($questions)>0){
        return response()->json(['status'=>200,'questions'=>$questions]);
        }
        else{
        return response()->json(['status'=>404]);
        }
    }
}
