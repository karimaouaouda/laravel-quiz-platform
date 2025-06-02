<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    /** @use HasFactory<\Database\Factories\AnswerFactory> */
    use HasFactory;

    protected $fillable = [
        'submission_id',
        'question_id',
        'choice_id',
        'skipped',
        'time_expired',
        'answer_duration'
    ];

    protected $casts = [
        'skipped' => 'boolean',
        'time_expired' => 'boolean',
    ];


    public function question(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Question::class);
    }

    public function choice(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Choice::class);
    }

    public function submission(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Submission::class);
    }

    public function isCorrect(): bool
    {
        return $this->choice()->first()->isCorrect();
    }
}
