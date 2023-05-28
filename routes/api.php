<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/


Route::POST('login', [App\Http\Controllers\SendTextMessageController::class,'login'])->name('sms.login');

Route::GET('users', [App\Http\Controllers\APIController::class,'users'])->name('api.users');
Route::GET('sms', [App\Http\Controllers\SendTextMessageController::class,'index'])->name('sms.index');
Route::POST('sms', [App\Http\Controllers\SendTextMessageController::class,'store'])->name('sms.store');
