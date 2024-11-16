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
        Schema::create('user_answers', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Foreign key linking to users table
            $table->foreignId('question_id')->constrained()->onDelete('cascade'); // Foreign key linking to questions table
            $table->foreignId('answer_id')->nullable()->constrained()->onDelete('cascade'); // Foreign key linking to answers table
            $table->boolean('is_correct')->default(false); // Whether the user's answer was correct
            $table->boolean('is_skipped')->default(false); // Whether the question is skipped
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_answers');
    }
};
