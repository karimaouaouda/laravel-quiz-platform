<?php

namespace App\Models;

use App\Enums\DifficultyLevel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Quiz extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'teacher_id',
        'subject_id',
        'code',
        'title',
        'questions_count',
        'difficulty_level',
        'status',
        'end_at',
    ];

    protected $casts = [
        'difficulty_level' => DifficultyLevel::class,
    ];

    /**
     * Get the questions for the quiz.
     */
    public function questions(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Question::class, 'quizzes_questions')
            ->withPivot('sort');
    }

    /**
     * Get the submissions for the quiz.
     */
    public function submissions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Submission::class);
    }
    /**
     * Get the teacher who created the quiz.
     */
    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }
}
