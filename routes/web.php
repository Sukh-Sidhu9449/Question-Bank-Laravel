<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;




// Route::get('/', function () {
//     return view('admin.dashboard');
// });
// Route::get('/login',function(){
//     return view('admin.login');
// });
// Route::get('/signup',function(){
//     return view('admin.signup');
//  });


Route::middleware(['disable_back_btn'])->group(function () {
    Auth::routes();
});




    
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
    });
  