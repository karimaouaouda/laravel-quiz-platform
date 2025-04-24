<?php

namespace App\Livewire\Quiz;

use App\Enums\DifficultyLevel;
use App\Livewire\Quiz;
use Livewire\Component;

class Index extends Component
{
    public int $perPage = 8;
    public array $subjects = [];

    public string $search = '';

    public int $count = 0;
    public array $difficulty = [
        DifficultyLevel::EASY->value => false,
        DifficultyLevel::HARD->value => false,
        DifficultyLevel::MEDIUM->value => false,
    ];

    public function loadMore(){
        $this->perPage += 8;
    }
    public function getQuery(): \Illuminate\Database\Eloquent\Builder
    {
        $query = \App\Models\Quiz::query();

        if (count($this->subjects)) {
            $query->whereIn('subject_id', $this->subjects);
        }

        if (count(array_filter($this->difficulty, fn($val) => $val))) {
            $query->whereIn('difficulty_level', array_keys(array_filter($this->difficulty, fn($val) => $val)));
        }

        if( !empty($this->search) ){
            $query->where(function($query){
               $query->where('title', 'like', '%'.$this->search.'%')
                   ->orWhere('description', 'like', '%'.$this->search.'%');
            });
        }

        $this->count = $query->count();

        return $query->limit($this->perPage);
    }

    public function render()
    {
        $quizzes = $this->getQuery()->get();
        return view('livewire.quiz.index', [
            'quizzes' => $quizzes,
        ]);
    }
}
