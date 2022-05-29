<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify'=>true]);

Route::middleware(['verified','admin'])->group(function () {

    Route::get('admin_dashboard',[AdminController::class,'index'])->name('admin_dashboard');

});
Route::middleware(['verified','customer'])->group(function () {

    Route::get('customer_dashboard',[CustomerController::class,'index'])->name('customer_dashboard');
    Route::get('change_email',[CustomerController::class,'change_email'])->name('change_email');
    Route::post('create',[CustomerController::class,'create'])->name('create');
    Route::get('chat',[ChatController::class,'index'])->name('chat');
    Route::post('chat_window',[ChatController::class,'chat_window'])->name('chat_window');
    Route::post('message_sent',[ChatController::class,'message_sent'])->name('message_sent');


});
Route::middleware(['employee'])->group(function () {

    Route::get('employee_dashboard',[EmployeeController::class,'index'])->name('employee_dashboard');

});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('event',[ChatController::class,'event'])->name('event');
