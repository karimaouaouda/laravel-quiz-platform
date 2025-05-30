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
use Livewire\Attributes\On;


class Pass extends Component
{

    public Quiz $quiz;

    public Question|Model $question;

    public Submission $submission;

    public ?string $answer = '';

    public int $timeLeft = 60;

    public function mount(): void
    {

        $this->quiz = Quiz::query()
            ->findOrFail(request('quiz'));


        $this->submission = Submission::query()
            ->firstOrCreate([
                'quiz_id' => $this->quiz->getAttribute('id'),
                'student_id' => Auth::id(),
            ]);


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
            $this->redirectIntended(route('quiz.result', [
                'submission' => $this->submission,
            ]));
        }else{
            $this->question = $question;
        
            $this->timeLeft = 60; // Reset timer for each question
        }

        
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

    public function validateAnswer($timeLeft = null): void {
        $duration = $timeLeft !== null ? (60 - (int)$timeLeft) : 0;
        $this->submission->answers()->create([
            'question_id' => $this->question->id,
            'choice_id' => $this->answer,
            'answer_duration' => $duration
        ]);
        $this->setup();
    }

    #[On('timeExpired')]
    public function timeExpired()
    {
        // Auto-submit with no answer or mark as unanswered
        $this->submission->answers()->create([
            'question_id' => $this->question->id,
            'choice_id' => $this->answer,
            'time_expired' => true
        ]);
        $this->setup();
    }

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory
    {
        return view('livewire.quiz.pass', [
            'question' => $this->question,
            'currentQuestionNumber' => 1, // Replace with actual logic
            'totalQuestions' => 10, // Replace with actual logic
        ]);
    }
}

