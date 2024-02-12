<?php

use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'auth' , 'localizationRedirect', 'localeViewPath' ]
    ], function(){
        //Admin Dahsboard 
        Route::prefix('admin')->name('admin.')->group( function () {
            Route::get('/', [Controller::class , 'dashboard'])->name('dashboard');
        // Admin profile
        Route::controller(ProfileController::class)->group( function () {
            Route::get('/users' , 'index');
        });
        });
        
});



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');