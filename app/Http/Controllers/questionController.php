<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class questionController extends Controller
{
    //
    // public function get_question($block_id,$u_id){
    //     $quiz_question_data=DB::table('block_questions')
    //     ->join('questions','block_questions.question_id','=','questions.id')
    //     ->where('block_id',$block_id)
    //     ->select('block_questions.block_id','block_questions.id','questions.id','questions.question')->get();

    //     return response()->json($quiz_question_data);
    // }
}
