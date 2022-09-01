<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class tech_user_Controller extends Controller
{
    //request
    public function index($id)

    {
      $tech=DB::table('technologies')->where('id',$id)->get();
      return response()->json($tech);
        
    }
    public function show($id){

        // $tech=DB::table('technologies')->where('id',$id)->get();
        $technologies = DB::table('technologies')->whereBetween('id', [1,10])->get();
        $frame1=DB::table('frameworks')->where('technology_id',$id)->get();
        //  dd($frame1);
       
       
        return view('user.technology',['technologies'=>$technologies,'frame1'=>$frame1]);
    }
    public function get_question(Request $request)
    {
    
           $fid= $request->id;
           $techid=$request->tech_id;
          //  $both_id=DB::table('questions')->where([
          //   ['framework_id',$fid], ['technology_id',$techid]
          //   ])->get();
          //   return response()->json([
          //     'ques'=>$both_id,
          //     'status'=>200
          //   ]);

            $d=DB::table('answers as a')
                        ->join('questions as q','q.id','=','a.question_id')
                        ->where([
                            ['q.framework_id',$fid],
                            ['q.technology_id',$techid]
                            ])
                        ->select('q.question','a.question_id','a.answer')
                        ->get();
                        if(count($d)>0){
                          return response()->json([
                            'ques'=>$d,
                            'status'=>200
                          ]);
                        }
                        else{
                          return response()->json([
                         
                            'status'=>404
                          ]);

                        }
                       
    }
         
}
