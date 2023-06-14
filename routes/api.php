<?php

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

Route::get('questions/{id}/voteup','App\Http\Controllers\QuestionController@voteUp');
Route::get('questions/{id}/votedown','App\Http\Controllers\QuestionController@voteDown');
Route::get('question/{id}/comments','App\Http\Controllers\QuestionController@getQuestionComments');
Route::post('comments/add','App\Http\Controllers\CommentaireController@store');
Route::get('questions/{id}/valider','App\Http\Controllers\CommentaireController@valider');


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

