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
        Schema::create('answers', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('question_id')->constrained()->onDelete('cascade'); // Foreign key linking to questions table
            $table->string('answer_text'); // The answer text
            $table->boolean('is_correct')->default(false); // Whether the answer is correct            
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answers');
    }
};
