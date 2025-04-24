<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Choice extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'question_id',
        'text',
        'is_correct',
    ];

    protected $casts = [
        'is_correct' => 'boolean',
    ];
    /**
     * Get the question that owns the choice.
     */
    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }

    public function isCorrect(): bool{
        return $this->getAttribute('is_correct');
    }
}
