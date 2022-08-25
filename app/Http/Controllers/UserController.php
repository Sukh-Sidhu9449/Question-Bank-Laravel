<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Facades\Datatables;



class UserController extends Controller
{
    public function index(){

        return view('admin.ListUsers');
    }
    public function getUsers(){
        $query = DB::table('users')->select('id', 'name', 'email', 'role', 'gender');
        return datatables($query)->make(true);
    }
}
