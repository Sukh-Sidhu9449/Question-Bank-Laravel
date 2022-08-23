<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;


class QuestionController extends Controller
{

    public function index()
    {
        $ques_ans=DB::table('answers as a')
                        ->join('questions as q','q.id','=','a.question_id')
                        ->select('q.question','a.question_id','a.answer')
                        ->get();
        $ques= DB::table('questions as q')
                    ->select(
                    'q.id',
                    'q.question'
                    )
                    ->leftJoin('answers as a', 'a.question_id', '=', 'q.id')
                    ->whereNull('a.question_id')
                    ->get();

        return response()->json([
            'Ques' => $ques,
            'QuesAnswer' => $ques_ans,
            'status' => 200
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $question_data = [
            'technology_id' => $request->ques_technology_id,
            'framework_id' => $request->ques_framework_id,
            'experience_id' => $request->ques_experience_id,
            'question' => $request->question,
            "created_at" => carbon::now()
        ];
        // $answer_data=[
        //     'experience_name' => $request->experience_name,
        //     "created_at" => carbon::now()
        // ];
        // return response()->json($request);
        DB::table('questions')->insert($question_data);
        // DB::table('experiences')->insert($answer_data);


        return response()->json([
            'status' => 200
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
