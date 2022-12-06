<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\UserAuthController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::controller(UserAuthController::class)->group(function(){
    Route::middleware("api.auth")->group(function(){
        Route::get("/logout", "logout");
        Route::get("/user/info", "user_info");
    });
    Route::post("/login" , "login");
    Route::post("/register", "register");
});
