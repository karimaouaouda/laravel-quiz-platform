<?php

namespace App\Livewire\Quiz;

use Livewire\Component;
use App\Models\Submission;
use Livewire\Attributes\Computed;
class Result extends Component
{
    public Submission $submission;

    #[Computed]
    public function score(){
        $questions_count = $this->submission->answers()->count(); // answers count is the same as questions count
        return $this->submission
            ->answers()
            ->whereHas('choice', function($q){
                $q->where('is_correct', true);
            })->count() / $questions_count * 100;
    }

    public function render()
    {
        return view('livewire.quiz.result', [
            'score' => $this->score,
        ]);
    }
}
