<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/save-user', [UserController::class, 'store'])->name('save.user');
Route::get('/questions', [QuizController::class, 'index'])->name('questions');
Route::post('/save-answer', [QuizController::class, 'saveAnswer']);
Route::get('/quiz-results', [QuizController::class, 'getResults'])->name('quiz.results');


