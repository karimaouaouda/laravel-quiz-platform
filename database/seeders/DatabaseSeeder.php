<?php

namespace Database\Seeders;

use App\Models\Choice;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\Subject;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(50)->create();
        Subject::factory(500)->create();
        Question::factory(1500)->create();
        Choice::factory(4500)->create();
        Quiz::factory(500)->create();
        foreach (Quiz::all() as $quiz) {
            $questions = Question::query()
                            ->where('teacher_id', $quiz->teacher_id)
                            ->where('subject_id', $quiz->subject_id)
                            ->get();

            if( $questions->count() <= 2 ) {
                continue;
            }
            $questions = $questions->random(3);

            $quiz->questions()->saveMany($questions);
        }
    }
}
