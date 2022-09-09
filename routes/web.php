<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\tech_user_Controller;
use App\Http\Controllers\UserUpdateController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\quiz_questionController;
use App\Http\Controllers\questionController;









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
        // Route::get('/view_profile',[UserUpdateController::class,'index'])->name('view_profile');

        Route::get('/user_edit',[UserUpdateController::class,'index']);
        Route::post('/user_edit',[UserUpdateController::class,'update'])->name('user_edit');
        Route::get('/core_php',[tech_user_Controller::class,'get_question']);
        Route::get('/notification/{u_id}',[NotificationController::class,'get_Notification']);
        Route::get('/get_count_value',[NotificationController::class,'get_COUNT']);
        Route::get('/quiz/{block_id}/{u_id}',[quiz_questionController::class,'quiz_question']);
        Route::post('/insertanswer',[quiz_questionController::class,'insert_answer']);
        Route::put('/updateanswer',[quiz_questionController::class,'update_answer']);
        






        
    });
    // Route::group(['middleware' => 'DisableBackBtn'],function(){
    //     Auth::routes();
    //     Route::get('/dashboard', [AuthController::class,'loadDashboard']);
    // });
  