<?php

namespace App\Livewire\Quiz;

use App\Models\Quiz;
use Illuminate\Support\Facades\Crypt;
use Livewire\Component;

class Code extends Component
{
    public string $code = '';

    public Quiz $quiz;

    public string $error = '';

    public function mount($quiz_id): void
    {
        $this->quiz = Quiz::FindOrFail($quiz_id);
    }
    public function checkCode()
    {
        if(empty($this->code)) {
            $this->error = 'Code cannot be empty';
            return false;
        }
        if ($this->code == $this->quiz->code) {
            $this->redirectIntended(route('quizzes.pass', [
                'quiz' => $this->quiz,
                'code' => Crypt::encrypt($this->quiz->code),
            ]));
        }else{
            $this->error = 'Code does not match';
        }
    }

    public function render()
    {
        $this->error = '';
        if($this->code != $this->quiz->code){
            $this->error = 'Code does not match';
        }

        if(empty($this->code)) {
            $this->error = 'Code cannot be empty';
        }

        return view('livewire.quiz.code', [
            'error' => $this->error
        ]);
    }
}
