<?php

namespace App\Livewire\Quiz;

use App\Models\Quiz;
use App\Models\Submission;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Pass extends Component
{

    public Quiz $quiz;

    public Submission $submission;

    public Collection $questions;

    public function mount(): void
    {
        $this->quiz = Quiz::findOrFail(request('quiz'));
        $quesry = Submission::query()
            ->where('quiz_id', $this->quiz->id)
            ->where('student_id', Auth::id());
        $this->submission = $quesry->exists() ? $quesry->first() : new Submission([
            'quiz_id' => $this->quiz->id,
            'student_id' => Auth::id(),
        ]);

        $this->submission->save();

        $this->questions = $this->quiz->questions()->orderByPivot('sort')->get();
    }
    public function render()
    {
        return view('livewire.quiz.pass');
    }
}
