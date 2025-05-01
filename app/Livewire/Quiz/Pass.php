<?php

namespace App\Livewire\Quiz;

use App\Models\Question;
use App\Models\Quiz;
use App\Models\Submission;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use JetBrains\PhpStorm\NoReturn;
use Livewire\Component;

class Pass extends Component
{

    public Quiz $quiz;

    public Question|Model $question;

    public Submission $submission;

    public ?string $answer = '';

    public function mount(): void
    {

        $this->quiz = Quiz::query()
            ->findOrFail(request('quiz'));



        $this->submission = Submission::query()
            ->firstOrCreate([
                'quiz_id' => $this->quiz->id,
                'student_id' => Auth::id(),
            ])->first();

        $this->setup();
    }

    public function setup(): void
    {
        // we will fetch the questions and order them then return the first one which have no answer

        //first let's get the answers which the user answer for this quiz
        $answers = $this->submission->answers()->get();

        // then we can retrieve the remaining questions
        $question = $this->quiz->questions()
            ->whereNotIn('questions.id', $answers->pluck('question_id')->toArray())
            ->orderByPivot('sort')
            ->first();

        if( !$question ){
            // the quiz finished just redirect the user to the finish screen

        }

        $this->question = $question;
    }

    public function nextQuestion(): void
    {
        $this->setup();
    }


    public function prevQuestion(): void
    {
        // just remove the last question from Database
        $this->setup();
    }

    public function cancelQuestion(): void
    {
        $this->redirectIntended('/');
    }

    public function validateAnswer(): void {
        $this->submission->answers()->create([
            'question_id' => $this->question->id,
            'choice_id' => $this->answer,
            'answer_duration' => 0
        ]);

        $this->setup();
    }
    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory
    {
        return view('livewire.quiz.pass', [
            'question' => $this->question,
        ]);
    }
}
