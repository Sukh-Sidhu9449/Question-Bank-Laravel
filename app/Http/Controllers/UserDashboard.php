<?php

namespace App\Http\Controllers;

use App\Models\UserQuiz;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;

use Illuminate\Http\Request;

class UserDashboard extends Controller
{
    public function index()
    {      
        try {
            $user = Auth::user();
    
            $globalInterviews = UserQuiz::count();
            $userInterviews = UserQuiz::where('users_id',$user->id)->count();
            $userAttempted = UserQuiz::where([['users_id',$user->id],['status','AR']])->orWhere([['users_id',$user->id],['status','S']])->count();
            $userPending = UserQuiz::where([['users_id',$user->id],['status','P']])->orWhere([['users_id',$user->id],['status','I']])->count();
            $data = ['globalInterviews'=>$globalInterviews,'userInterviews'=>$userInterviews,'userAttempted'=>$userAttempted,'userPending'=>$userPending];
        } catch (QueryException $ex) {
            return response()->json([
                'message' => $ex->getMessage(),
                'status' => 404
            ]);
        }
        return response()->json(['data'=>$data,'status'=>200]);
        // dd($data);
        
    }
}
