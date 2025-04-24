<?php

namespace App\Filament\Resources\QuizResource\Pages;

use App\Filament\Resources\QuizResource;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\User;
use Filament\Actions;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ManageRecords;
use Filament\Support\Colors\Color;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\HtmlString;

class QuizQuestions extends ManageRecords
{

    protected static string $resource = QuizResource::class;

    public Quiz $record;


    protected function getTableQuery(): ?Builder
    {
        //dd($query->toRawSql());
        return Question::query()
            ->join('quizzes_questions', 'quizzes_questions.question_id', '=', 'questions.id')
            ->where('quizzes_questions.quiz_id', '=', $this->record->getAttribute('id'));
    }

    public function table(\Filament\Tables\Table $table): \Filament\Tables\Table
    {
        return $table
            ->reorderable('sort')
            ->defaultSort('questions.sort')
            ->columns([
                TextColumn::make('question_id')
                    ->prefix('#')
                    ->badge(),
                TextColumn::make('text')
                    ->html()
                    ->searchable(),
            ])->actions([
                DeleteAction::make(),
            ])->filters([

            ])->bulkActions([

            ])->headerActions([
                Action::make('generate random questions')
                    ->icon('heroicon-o-arrow-path')
                    ->color(Color::Blue)
                    ->form([
                        TextInput::make('questions_count')
                            ->integer()
                            ->minValue(1)
                            ->required()
                            ->default(5)
                            ->hint('the number of questions will attached')
                    ])
                    ->action(function(array $data){
                        $diff_level = $this->record->getAttribute('difficulty_level');
                        $subject_id = $this->record->getAttribute('subject_id');
                        $count = $data['questions_count'];

                        $available_questions = Question::query()
                            ->where('teacher_id', $this->record->getAttribute('teacher_id'))
                            ->where('difficulty_level', $diff_level)
                            ->where('subject_id', $subject_id)
                            ->get();

                        $questions_to_attach = $available_questions->random($count);

                        $values = [];

                        $questions_to_attach->each(function (Question $question) use (&$values) {
                            $arr = [];
                            $arr['quiz_id'] = $this->record->getAttribute('id');
                            $arr['question_id'] = $question['id'];
                            $arr['attached_at'] = now();

                            $values[] = $arr;
                        });

                        try{
                            DB::table('quizzes_questions')
                                ->insert($values);
                        }catch (\Exception $exception){
                            Notification::make()
                                ->title('error')
                                ->body($exception->getMessage())
                                ->color(Color::Red);
                        }

                    }),
                Action::make('attach questions')
                    ->icon('heroicon-o-plus')
                    ->form([
                        Select::make('questions')
                            ->multiple()
                            ->options(function(){
                                $already = DB::table('quizzes_questions')
                                                ->where('quiz_id', $this->record->getAttribute('id'))
                                                ->pluck('question_id')
                                                ->toArray();
                                return Question::query()
                                            ->where('teacher_id', $this->record->getAttribute('teacher_id'))
                                            ->where('subject_id', $this->record->getAttribute('subject_id'))
                                            ->where('difficulty_level', $this->record->getAttribute('difficulty_level'))
                                            ->whereNotIn('id', $already)
                                            ->pluck('text', 'id');
                            })
                    ])
            ]);
    }
}
