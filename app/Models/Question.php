<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['question_text'];

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

}
