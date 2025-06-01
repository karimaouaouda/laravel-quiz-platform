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
        return $this->submission->score;
    }

    public function render()
    {
        return view('livewire.quiz.result', [
            'score' => $this->score,
        ]);
    }
}
