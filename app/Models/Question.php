<?php

namespace App\Models;

use App\Enums\DifficultyLevel;
use App\Enums\QuestionType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Question extends Model
{
    /** @use HasFactory<\Database\Factories\QuestionFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'teacher_id',
        'subject_id',
        'text',
        'difficulty_level',
        'time_limit',
        'question_type'
    ];

    /**
     * Cast the type attribute to the QuestionType enum.
     *
     * @var array
     */
    protected $casts = [
        'difficulty_level' => DifficultyLevel::class,
        'question_type' => QuestionType::class,
    ];

    /**
     * Get the quiz that owns the question.
     */
    public function quizzes(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Quiz::class, 'quizzes_questions')
            ->withPivot('sort');
    }

    /**
     * Get the choices for the question.
     */
    public function choices(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Choice::class);
    }

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }
}
