<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Facades\Datatables;



class UserController extends Controller
{
    public function index(){
        $users=DB::table('users')->get();
        return view('admin.ListUsers')->with(['users'=>$users]);
    }
    public function getUsers(){

    }
}
