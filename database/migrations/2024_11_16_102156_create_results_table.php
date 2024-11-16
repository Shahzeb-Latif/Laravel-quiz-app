<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('results', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Foreign key linking to users table
            $table->integer('total_questions'); // Total number of questions in the quiz
            $table->integer('correct_answers')->default(0); // Number of correct answers
            $table->integer('wrong_answers')->default(0); // Number of wrong answers
            $table->integer('skipped_questions')->default(0); // Number of skipped questions
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('results');
    }
};
