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
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('sendMessage', 'App\Http\Controllers\admin@sendMessage');
Route::post('createNewUser', 'App\Http\Controllers\admin@createUser');
Route::get('Users', 'App\Http\Controllers\admin@getUsers');
Route::post('editUser', 'App\Http\Controllers\admin@editUser');
Route::post('login', 'App\Http\Controllers\admin@login');
Route::post('deleteUser', 'App\Http\Controllers\admin@delete');
Route::post('logout', 'App\Http\Controllers\admin@logout');



