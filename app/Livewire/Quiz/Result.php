<?php

namespace App\Livewire\Quiz;

use Livewire\Component;
use App\Models\Submission;
use Livewire\Attributes\Computed;
class Result extends Component
{
    public Submission $submission;

    #[Computed]
    public function score(): float|int
    {
        $answers = $this->submission->answers;
        $questions = $this->submission->quiz->questions;
        $correct_choices = 0;
        foreach ($questions as $question){
            $correct_choices += $question->correct_choices_count;
        }
        // answers count is the same as questions count
        $questions_count = $this->submission->answers()->count();
        return $this->submission
            ->answers()
            ->whereHas('choice', function($q){
                $q->where('is_correct', true);
            })->count() / $correct_choices * 100;
    }

    public function render()
    {
        return view('livewire.quiz.result', [
            'score' => $this->score,
        ]);
    }
}
