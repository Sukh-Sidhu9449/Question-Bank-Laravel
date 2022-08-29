<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $technologies = DB::table('technologies')->orderBy('technology_name', 'asc')->get();
        return view('admin.ListUsers', ['technologies' => $technologies]);
    }
    public function getUsers()
    {
        $query = DB::table('users as u')
            ->join('usertechnology as ut', 'u.id', '=', 'ut.users_id')
            ->select('u.id', 'u.name', 'u.email', 'u.role', 'ut.technology_name', 'ut.designation', 'ut.current_company', 'ut.experience');

        return datatables($query)->make(true);
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $validate = Validator::make($request->all(), [
            'name' => 'string|required|min:4',
            'email' => 'string|email|required|max:100|unique:users',
            'password' => 'string|required|confirmed|min:8'
        ]);
        if ($validate->passes()){
            $values = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => $request->role,
            ];
            $query = DB::table('users')->insert($values);
            if ($query) {
                $id = DB::table('users')->select('id')->where('name', $request->name)->value('id');
                $technology_data = [
                    'users_id' => $id,
                    'technology_name' => $request->technology_name,
                    'designation' => $request->designation,
                    'current_company' => $request->current_company,
                    'last_company' => $request->last_company,
                    'experience'=>$request->experience,
                ];
                $query2=DB::table('usertechnology')->insert($technology_data);
                if($query2){
                    return response()->json(['status' => 200]);
                }
            }
        } else{
            return response()->json(['status' => 409, 'errors' => $validate->errors()->toArray()]);
        }
    }

    
}
