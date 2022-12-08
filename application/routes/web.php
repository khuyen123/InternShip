<?php

use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\Users\Logincontroller;
use App\Http\Controllers\Admin\Users\UserController;
use App\Models\Categories;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Route Đăng nhập
Route::get('admin/user/login',[Logincontroller::class,'index'])->name('login');
Route::get('admin/user/logout',[Logincontroller::class,'logout']);

Route::post('admin/user/login/store',[Logincontroller::class,'store']);
//Route đăng ký
Route::get('admin/user/register',[UserController::class,'register']);
Route::post('admin/user/register/store',[UserController::class,'register_store']);
//Check Đăng nhập
Route::middleware(['auth'])->group(function(){
    //Group admin
    Route::prefix('admin')->group( function(){
        Route::get('/home',[HomeController::class,'index'])->name('home');
        //Categories
        Route::prefix('/categories')->group(function() {
            Route::get('/fetchCate',[CategoriesController::class,'getAll']);
            Route::get('/index',[CategoriesController::class,'index']);
            Route::get('/find/{id}',[CategoriesController::class,'find']);
    
        });

        Route::group([
            'prefix' => 'categories',
            'middleware' => 'admin_employee'
        ], function() {
            
            Route::post('/edit/{id}',[CategoriesController::class,'update_2']);
            Route::post('/create',[CategoriesController::class,'store']);
            Route::DELETE('/delete',[CategoriesController::class,'destroy']);
            Route::DELETE('/destroyMany',[CategoriesController::class,'destroyMany']);
            Route::post('/edit/{categories}',[CategoriesController::class,'update']);
        });
        //Users
        Route::group([
            'prefix' => 'users',
            'middleware' => 'admin'
        ],function()  {
            Route::get('/index',[UserController::class,'index']);
            Route::get('/getAll',[UserController::class,'getAll']);
            Route::get('/create',[UserController::class,'create']);
            Route::get('/search',[UserController::class,'search'])->name('search');
            Route::post('/create',[UserController::class,'store']);
            Route::get('/find/{id}',[UserController::class,'find']);
            Route::get('/edit/changePass/{user}',[UserController::class,'changePass_edit']);
            Route::post('/edit/changePass/{user_id}',[UserController::class,'changePass']);
            Route::post('/edit/{user_id}',[UserController::class,'update']);
            Route::DELETE('/delete',[UserController::class,'destroy']);
            Route::DELETE('/deleteMany',[UserController::class,'destroyMany']);
        });
    });
});
Route::get('/', function () {
    return view('welcome');
});
