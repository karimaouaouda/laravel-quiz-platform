<?php

namespace App\Livewire\Quiz;

use App\Enums\QuestionType;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\Submission;
use Filament\Notifications\Notification;
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

    public array $answers = [];

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
        // first let's get the answers which the user answer for this quiz
        $answers = $this->submission->answers()->get();

        // then we can retrieve the remaining questions
        $question = $this->quiz->questions()
            ->whereNotIn('questions.id', $answers->pluck('question_id')->toArray())
            ->orderByPivot('sort')
            ->first();

        if( !$question ){
            Notification::make()
                ->title('new submission for quiz : #' . $this->quiz->getAttribute('id'))
                ->body(sprintf("student : %s answered your quiz (#%d)", $this->submission->student->name, $this->quiz->getAttribute('id')))
                ->info()
                ->sendToDatabase($this->quiz->teacher);
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
    #[On('cancelQuiz')]
    public function cancelQuiz(): void
    {
        $this->submission->delete();
        $this->redirectIntended(route('filament.student.pages.dashboard'));
    }

    public function validateAnswer($timeLeft = null): void {
        if( !$this->submission ){
            $this->submission = Submission::query()
                ->firstOrCreate([
                    'quiz_id' => $this->quiz->getAttribute('id'),
                    'student_id' => Auth::id(),
                ]);
        }
        $duration = $timeLeft !== null ? (60 - (int)$timeLeft) : 0;
        if( $this->question->getAttribute('question_type') == QuestionType::MULTIPLE_CHOICE){
            if( count($this->answers) <= 0 ){
                $this->dispatch('validationError', [
                   'message' => 'multiple choices must be at least one selected'
                ]);
                return;
            }

            foreach ($this->answers as $choice_id => $value){
                $this->submission->answers()->create([
                    'question_id' => $this->question->id,
                    'choice_id' => $choice_id,
                    'answer_duration' => $duration
                ]);
            }
        }else{
            if( empty($this->answer) ){
                $this->dispatch('validationError', [
                    'message' => 'answer must be at least one selected'
                ]);
                return;
            }
            $this->submission->answers()->create([
                'question_id' => $this->question->id,
                'choice_id' => $this->answer,
                'answer_duration' => $duration
            ]);
        }

        $this->setup();
    }

    #[On('timeExpired')]
    public function timeExpired()
    {
        // Auto-submit with no answer or mark as unanswered
        $this->submission->answers()->create([
            'question_id' => $this->question->id,
            'choice_id' => empty($this->answer) ? null : $this->answer,
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

