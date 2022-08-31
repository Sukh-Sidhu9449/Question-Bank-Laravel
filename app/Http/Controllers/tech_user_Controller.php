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
        $technologies = DB::table('technologies') ->whereBetween('id', [1,10])->get();
        $frame1=DB::table('frameworks')->where('technology_id',$id)->get();
        //  dd($frame1);
       
       
        return view('user.technology',['technologies'=>$technologies,'frame1'=>$frame1]);
    }
}
