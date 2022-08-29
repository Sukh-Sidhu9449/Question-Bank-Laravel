<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user;
use App\Models\Datamodel;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Session;


class AuthController extends Controller
{
    //
    public function loadRegister()
    {
        if(Auth::user() && Auth::user()->role=='admin')
        {
         return redirect('/admin/dashboard');
        }
        else if(Auth::user() && Auth::user()->role=='user')
        {
         return redirect('/dashboard');
        }
        return view('register');
    }
    public function userRegister(Request $request)

    {
        $request->validate([
            'name'=>'string|required|min:4',
            'email'=>'string|email|required|max:100|unique:users',
            'password'=>'string|required|confirmed|min:8'
        ]);
        $user =new User;
         $user->name=$request->name;
         $user->email=$request->email;
         $user->password=bcrypt($request->password);
         $user->save();

         return response()->json(['success'=>'succesfully']);

    }
    public function loadlogin()
    {
        
       if(Auth::user() && Auth::user()->role=='admin')
       {
        return redirect('/admin/dashboard');
       }
       else if(Auth::user() && Auth::user()->role=='user')
       {
        return redirect('/dashboard');
       }
       return view('login');
    }
    public function userlogin(Request $request)
    {
        
        $request->validate([

            'email'=>'string|required|email',
            'password'=>'string|required'

        ]);
        $userCredential=$request->only('email','password');
        if(Auth::attempt($userCredential))
        {
                if(Auth::user()->role=='admin')
                {
                    return "admin";
                }
                else{
                    return "user";

                }
                return response()->json(['success'=>'login']);
        }
        else{
            // return  back()->with('error','Credential is invalid');
        return response()->json(['error'=>'invalid credentials']);
        }
    }
     public function loadDashboard(){

// ***************dynamic navbar****************************************************************************
        $leftmenu=new DataModel();
        $leftmenu=$leftmenu->getmenu();
        
        $l_menu=new DataModel();
        $l_menu=$l_menu->getmenu2();
        
        $menu=new Datamodel();
        $menu=$menu->get_menu();
        //dd($menu);

        return view('/dashboard',$l_menu,$leftmenu,$menu);
        return view('/dashboard',$menu);
        

     
//***************************end here********************************************************************** */ 
     }
     public function adminDashboard(){
        return view('admin.dashboard');
     }
     public function logout(Request $request)
     {
        $request->Session()->flush();
        Auth::logout();
        return redirect('/'); 
     }
}
