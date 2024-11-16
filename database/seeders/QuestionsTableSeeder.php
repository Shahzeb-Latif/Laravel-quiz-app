<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Question;
use App\Models\Answer;

class QuestionsTableSeeder extends Seeder
{
    public function run()
    {
        // Questions with answers
        $questions = [
            [
                'question_text' => 'What does PHP stand for?',
                'answers' => [
                    ['answer_text' => 'Personal Home Page', 'is_correct' => true],
                    ['answer_text' => 'Private Home Page', 'is_correct' => false],
                    ['answer_text' => 'Professional Home Page', 'is_correct' => false],
                    ['answer_text' => 'Programmed Home Page', 'is_correct' => false],
                ],
            ],
            [
                'question_text' => 'Which HTML tag is used to define an internal style sheet?',
                'answers' => [
                    ['answer_text' => '<style>', 'is_correct' => true],
                    ['answer_text' => '<script>', 'is_correct' => false],
                    ['answer_text' => '<css>', 'is_correct' => false],
                    ['answer_text' => '<link>', 'is_correct' => false],
                ],
            ],
            [
                'question_text' => 'Which SQL statement is used to retrieve data from a database?',
                'answers' => [
                    ['answer_text' => 'SELECT', 'is_correct' => true],
                    ['answer_text' => 'INSERT', 'is_correct' => false],
                    ['answer_text' => 'UPDATE', 'is_correct' => false],
                    ['answer_text' => 'DELETE', 'is_correct' => false],
                ],
            ],
            [
                'question_text' => 'Which of the following is a JavaScript framework?',
                'answers' => [
                    ['answer_text' => 'Angular', 'is_correct' => true],
                    ['answer_text' => 'Laravel', 'is_correct' => false],
                    ['answer_text' => 'Django', 'is_correct' => false],
                    ['answer_text' => 'Spring', 'is_correct' => false],
                ],
            ],
            [
                'question_text' => 'What does CSS stand for?',
                'answers' => [
                    ['answer_text' => 'Cascading Style Sheets', 'is_correct' => true],
                    ['answer_text' => 'Computer Style Sheets', 'is_correct' => false],
                    ['answer_text' => 'Creative Style Sheets', 'is_correct' => false],
                    ['answer_text' => 'Colorful Style Sheets', 'is_correct' => false],
                ],
            ],
        ];

        // Insert questions and answers
        foreach ($questions as $q) {
            $question = Question::create([
                'question_text' => $q['question_text'],
            ]);

            foreach ($q['answers'] as $answer) {
                Answer::create([
                    'question_id' => $question->id,
                    'answer_text' => $answer['answer_text'],
                    'is_correct' => $answer['is_correct'],
                ]);
            }
        }
    }
}
