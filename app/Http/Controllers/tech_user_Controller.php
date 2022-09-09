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
           $exp_id=$request->experience_id;

            if($exp_id==0)
            {
                $d=DB::table('questions as q')
                ->join('answers as a','a.question_id','=','q.id')
                ->join('frameworks as f','f.id','=','q.framework_id')
                ->where([
                  ['q.framework_id',$fid],
                  ['f.technology_id',$techid]
              ]);
            }
            else{
                $d=DB::table('questions as q')
                ->join('answers as a','a.question_id','=','q.id')
                ->join('frameworks as f','f.id','=','q.framework_id')
                ->where([
                  ['q.framework_id',$fid],
                  ['f.technology_id',$techid],
                  ['q.experience_id',$exp_id]
              ]);
            }
             $d= $d->select('q.question','a.question_id','a.answer')
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
