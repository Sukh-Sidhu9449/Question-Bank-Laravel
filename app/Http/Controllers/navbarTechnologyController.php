<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class navbarTechnologyController extends Controller
{
    //
        public static function show()
    
    {
        $technologies = DB::table('technologies') ->offset(0)->limit(7)->get();
        $technologies2 = DB::table('technologies') ->offset(3)->limit(4)->get();
        $technologies3 = DB::table('technologies')->get();
        //dd($technologies);
        return view('/dashboard', ['technologies' => $technologies,'technologies2'=>$technologies2,'technologies3'=> $technologies3]);
    }

    public static function newShow()
    
    {
        $popularTechnologies = DB::table('technologies')->offset(0)->limit(3)->get();
        $query = DB::table('technologies')->offset(0)->limit(7)->get();
        
        $technologies = array();
        foreach($query as $key=> $userTech)
        {
            $array['technology_id'] = $userTech->id;
            $array['technology_name'] = $userTech->technology_name;
            $array['frameworks'] = navbarTechnologyController::getFrameworks($userTech->id);
            
            $technologies[] = $array;
        }
        // print '<pre>';
        // print_r($quizQuestionData);
        // exit;
        
        $technologies3 = DB::table('technologies')->get();
        //dd($technologies);
        return view('newpage', ['popularTechnologies' => $popularTechnologies,'technologies'=>$technologies,'technologies3'=> $technologies3]);
    }

    public static function getFrameworks($technology_id)
    {
        $query = DB::table('frameworks')->select('id','framework_name')->where('technology_id',$technology_id)->get();
        $result = json_decode($query, true);
        return $result;
    }

}
