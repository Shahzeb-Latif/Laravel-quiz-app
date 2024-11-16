<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use App\Models\UserAnswer;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index()
    {
        // Fetch questions and their answers
        $questions = Question::with('answers')->get();

        return view('questions', compact('questions'));
    }

    public function saveAnswer(Request $request)
    {
        // Get user_id from session
        $userId = session('user_id');

        if (!$userId) {
            return response()->json(['success' => false, 'message' => 'User not found in session.'], 403);
        }

        // Validate the input
        $request->validate([
            'question_id' => 'required|exists:questions,id',
            'answer_id' => 'nullable|exists:answers,id',
        ]);

        // Determine if the question was skipped
        $isSkipped = is_null($request->answer_id);

        // Save or update the user's response
        $userAnswer = UserAnswer::updateOrCreate(
            [
                'user_id' => $userId,
                'question_id' => $request->question_id,
            ],
            [
                'answer_id' => $request->answer_id,
                'is_correct' => !$isSkipped && $request->answer_id ? Answer::find($request->answer_id)->is_correct : false,
                'is_skipped' => $isSkipped,
            ]
        );

        return response()->json(['success' => true]);
    }

    public function getResults()
    {
        // Get user_id from session
        $userId = session('user_id');

        if (!$userId) {
            return response()->json(['success' => false, 'message' => 'User not found in session.'], 403);
        }

        // Retrieve user answers and calculate results
        $totalQuestions = Question::count();
        $answeredQuestions = UserAnswer::where('user_id', $userId)->where('is_skipped', false)->count();
        $correctAnswers = UserAnswer::where('user_id', $userId)->where('is_correct', true)->count();
        $skippedQuestions = UserAnswer::where('user_id', $userId)->where('is_skipped', true)->count();

        return response()->json([
            'success' => true,
            'total_questions' => $totalQuestions,
            'answered_questions' => $answeredQuestions,
            'correct_answers' => $correctAnswers,
            'skipped_questions' => $skippedQuestions,
        ]);
    }

}
