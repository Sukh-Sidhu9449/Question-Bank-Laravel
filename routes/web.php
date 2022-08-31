<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\tech_user_Controller;





// Route::get('/', function () {
//     return view('admin.dashboard');
// });
// Route::get('/login',function(){
//     return view('admin.login');
// });
// Route::get('/signup',function(){
//     return view('admin.signup');
//  });






    
    Route::get('/register',[AuthController::class,'loadRegister']);
    
    Route::post('/register',[AuthController::class,'userRegister'])->name('userRegister');
    
    Route::get('/login',function(){
    
        return redirect('/');
    
    });
    Route::get('/',[AuthController::class,'loadlogin']);
    
    Route::post('/login',[AuthController::class,'userlogin'])->name('userlogin');
    
    Route::get('/logout',[AuthController::class,'logout'])->name('logout');



    Route::group(['middleware'=>['web','checkadmin']],function(){

        Route::get('/admin/dashboard',[AuthController::class,'adminDashboard']);
        Route::get('/admin/technologies',function(){
        return view('admin.technologies');
        });
        Route::get('/admin/profile',function(){
            return view('admin.user');
            });
    });
    Route::group(['middleware'=>['web','checkuser']],function(){
        
        Route::get('/dashboard',[AuthController::class,'loadDashboard']);
        Route::get('/tech_data/{id}',[tech_user_Controller::class,'index']);
        Route::get('/user_tech/{id}',[tech_user_Controller:: class,'show']);




        
    });
    // Route::group(['middleware' => 'DisableBackBtn'],function(){
    //     Auth::routes();
    //     Route::get('/dashboard', [AuthController::class,'loadDashboard']);
    // });
  