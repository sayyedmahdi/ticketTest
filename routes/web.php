<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'department'] , function () {
   Route::post('/create' , [App\Http\Controllers\DepartmentController::class , 'create']);
   Route::post('/edit' , [App\Http\Controllers\DepartmentController::class , 'edit']);
   Route::delete('/delete' , [App\Http\Controllers\DepartmentController::class , 'delete']);
   Route::post('/change_status' , [App\Http\Controllers\DepartmentController::class , 'changeStatus']);
   Route::get('/{id}/tickets' , [App\Http\Controllers\DepartmentController::class , 'tickets']);
   Route::get('/list' , [App\Http\Controllers\DepartmentController::class , 'list']);
});

Route::group(['prefix' => 'ticket'] , function () {
    Route::post('/create' , [App\Http\Controllers\TicketsController::class , 'create']);
    Route::delete('/delete' , [App\Http\Controllers\TicketsController::class , 'delete']);
    Route::post('/change_status' , [App\Http\Controllers\TicketsController::class , 'changeStatus']);
    Route::post('/change_department' , [App\Http\Controllers\TicketsController::class , 'changeDepartment']);
    Route::post('/user_tickets' , [App\Http\Controllers\TicketsController::class , 'userTickets']);
    Route::get('/list' , [App\Http\Controllers\TicketsController::class , 'list']);
    Route::get('/{id}' , [App\Http\Controllers\TicketsController::class , 'show']);
});

Route::group(['prefix' => 'ready_messages'] , function () {
    Route::post('/create' , [App\Http\Controllers\ReadyMessagesController::class , 'create']);
    Route::post('/edit' , [App\Http\Controllers\ReadyMessagesController::class , 'edit']);
    Route::delete('/delete' , [App\Http\Controllers\ReadyMessagesController::class , 'delete']);
    Route::post('/change_status' , [App\Http\Controllers\ReadyMessagesController::class , 'changeStatus']);
    Route::get('/{id}' , [App\Http\Controllers\ReadyMessagesController::class , 'show']);
    Route::get('/list' , [App\Http\Controllers\ReadyMessagesController::class , 'list']);
});

Route::group(['prefix' => 'ticket_message'] , function () {
    Route::post('/create' , [App\Http\Controllers\TicketMessageController::class , 'create']);
});
