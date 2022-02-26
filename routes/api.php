<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\QuestionsController;
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




// Public routes  

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/users', [AuthController::class, 'users']);

Route::get('/dashboard', [HomeController::class, 'dashboard']);
Route::get('/files', [HomeController::class, 'files']);

Route::get('/client', [HomeController::class, 'client']);
Route::get('/sublob', [HomeController::class, 'sublob']);
Route::get('/hub', [HomeController::class, 'hub']);
Route::get('/state', [HomeController::class, 'state']);
Route::get('/city', [HomeController::class, 'city']);
Route::get('/location', [HomeController::class, 'location']);


Route::get('/questionsgroups', [QuestionsController::class, 'questionsgroups']);
Route::get('/questions', [QuestionsController::class, 'questions']);
Route::get('/lookups', [QuestionsController::class, 'lookups']);



Route::post('/fileupload', [QuestionsController::class, 'fileupload']);
Route::post('/caseresponse', [QuestionsController::class, 'caseresponse'])->name('caseresponse');


// Protected routes

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});
