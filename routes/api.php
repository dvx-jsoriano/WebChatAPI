<?php

use App\Http\Controllers\AgentController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::post('/refresh', [AuthController::class, 'refresh']);
Route::post('/me', [AuthController::class, 'me']);

//Route::apiResource('agent', 'AgentController');
Route::apiResource('agent', 'App\Http\Controllers\AgentController');


Route::get('/test-random', function () {
    $data = collect([]);
    $value = Illuminate\Support\Str::random(16);
    $value = strtoupper($value);
    $data->push(["string random" => $value]);

    $value = '';
    $value = rand();
    $value = sha1($value);
    $data->push(["string sha1" => $value]);

    $value = 'C';
    for ($i = 0; $i < 15; $i++)
        $value .= mt_rand(0, 9);
    $data->push(["string rand numbers" => $value]);

    return $data;
});
