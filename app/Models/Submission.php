<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'student_id', // Foreign key for the user who made the submission
        'quiz_id', // Foreign key for the related quiz
    ];

    public function getScoreAttribute(){
        $questions_count = $this->answers()->count(); // answers count is the same as questions count
        return $this->correct_answers_count / $questions_count * 100;
    }

    public function getCorrectAnswersCountAttribute(){
        return $this->answers()->whereHas('choice', function($q){
            $q->where('is_correct', true);
        })->count();
    }

    /**
     * Get the user who made this submission.
     */
    public function student(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    /**
     * Get the quiz this submission belongs to.
     */
    public function quiz(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Quiz::class);
    }

    /**
     * Get the answers for this submission.
     */
    public function answers(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Answer::class);
    }
}
