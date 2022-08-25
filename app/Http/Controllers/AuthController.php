<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class AuthController extends Controller
{
    //
    public function loadRegister()
    {
        if (Auth::user() && Auth::user()->role == 'admin') {
            return redirect('/admin/dashboard');
        } else if (Auth::user() && Auth::user()->role == 'user') {
            return redirect('/dashboard');
        }
        return view('register');
    }
    public function userRegister(Request $request)

    {
        $request->validate([
            'name' => 'string|required|min:4',
            'email' => 'string|email|required|max:100|unique:users',
            'password' => 'string|required|confirmed|min:8'
        ]);
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return response()->json(['success' => 'succesfully']);
    }
    public function loadlogin()
    {
        if (Auth::user() && Auth::user()->role == 'admin') {
            return redirect('/admin/dashboard');
        } else if (Auth::user() && Auth::user()->role == 'user') {
            return redirect('/dashboard');
        }
        return view('login');
    }
    public function userlogin(Request $request)
    {
        $request->validate([

            'email' => 'string|required|email',
            'password' => 'string|required'

        ]);
        $userCredential = $request->only('email', 'password');
        if (Auth::attempt($userCredential)) {
            if (Auth::user()->role == 'admin') {
                return response()->json('admin');
            } else {
                return response()->json('user');
            }
        } else {
            return response()->json(['error' => 'invalid credentials']);
        }
    }

    public function index()
    {

        return view('admin.profile');
    }

    public function getProfileData()
    {
        $user_id = Auth::user()->id;
        $data = DB::table('users')->where('id',$user_id)->get();
        return response()->json($data);
    }

    public function update(Request $request)
    {
        $id = Auth::user()->id;

        $data = [
            "name" => $request->profile_name,
            "email" => $request->profile_email,
            "gender" => $request->profile_gender,
            "address" =>$request->profile_address,
        ];
        // dd($data);
        DB::table('users')->where('id','=',$id)->update($data);
        return redirect()->back()->with('status','Student Updated Successfully');
        // $query = DB::table('users')->where('id', '=', $id)->update($data);
        // if ($query) {
        //     return response()->json([
        //         'message' => 'Student Updated Successfully',
        //         'status' => 200
        //     ]);
        // } else {
        //     return response()->json([
        //         'message' => 'Student Update Failed',
        //         'status' => 404
        //     ]);
        // }
    }
    public function dashboardData(){
        $technology=DB::table('technologies')->get();
        $technology=count($technology);
        $user=DB::table('users')->get();
        $user=count($user);
        $questions=DB::table('questions')->get();
        $questions=count($questions);
        return response()->json([
            'technologies'=>$technology,
            'users'=>$user,
            'questions'=>$questions,
        ]);
    }

    public function loadDashboard()
    {
        return view('/dashboard');
    }
    public function adminDashboard()
    {
        return view('admin.dashboard');
    }
    public function logout(Request $request)
    {
        $request->Session()->flush();
        Auth::logout();
        return redirect('/');
    }
}
