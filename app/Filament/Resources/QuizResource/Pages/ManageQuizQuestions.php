<?php

namespace App\Filament\Resources\QuizResource\Pages;

use App\Filament\Resources\QuestionResource;
use App\Filament\Resources\QuizResource;
use App\Models\Question;
use Filament\Actions;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ManageRelatedRecords;
use Filament\Support\Colors\Color;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ManageQuizQuestions extends ManageRelatedRecords
{
    protected static string $resource = QuizResource::class;


    protected static string $relationship = 'questions';


    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationLabel(): string
    {
        return 'Questions';
    }

    public function form(Form $form): Form
    {
        return (new QuestionResource())->form($form);
    }

    protected function getDefaultTableSortColumn(): ?string
    {
        return 'quizzes_questions.sort';
    }


    public function table(Table $table): Table
    {
        return $table
            ->reorderable('quizzes_questions.sort')
            ->defaultSort('sort')
            ->recordTitleAttribute('text')
            ->columns([
                Tables\Columns\TextColumn::make('text')
                    ->html(),

            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
                Action::make('Attach')
                    ->color(Color::Gray)
                    ->form([
                        Forms\Components\Select::make('questions')
                            ->multiple()
                            ->minItems(1)
                            ->preload()
                            ->options(function(){
                                return Auth::user()
                                    ->questions()
                                    ->where('subject_id', $this->record->subject->id)
                                    ->where('difficulty_level', $this->record->difficulty_level)
                                    ->get()
                                    ->pluck('text', 'id')
                                    ->toArray();
                            })->allowHtml()
                    ])->action(function(array $data){
                        $selected_questions = array_values($data['questions']);
                        $max_questions = $this->record->getAttribute('questions_count');
                        $quiz_old_questions = $this->record->questions()->pluck('questions.id')->toArray();
                        $selected_questions = array_diff($selected_questions, $quiz_old_questions);

                        if(count($selected_questions) > $max_questions){
                            Notification::make()
                                ->title('error')
                                ->body('you can not attach more than ' . $max_questions . ' questions')
                                ->danger()
                                ->send();
                            return;
                        }
                        $this->record->questions()->syncWithoutDetaching($selected_questions);
                    }),
                Action::make('select random questions')
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
                        $subject_id = $this->record->getAttribute('subject_id');
                        $count = $data['questions_count'];
                        $quiz_old_questions = $this->record->questions()->pluck('questions.id')->toArray();

                        $available_questions = Question::query()
                            ->where('teacher_id', $this->record->getAttribute('teacher_id'))
                            ->where('subject_id', $subject_id)
                            ->where('difficulty_level', $this->record->getAttribute('difficulty_level'))
                            ->whereNotIn('id', $quiz_old_questions)
                            ->get();

                        if($available_questions->count() < $count){
                            Notification::make()
                                ->title('error')
                                ->body('not enough questions, available : ' . $available_questions->count())
                                ->warning()
                                ->send();

                            return;
                        }

                        $max_questions = $this->record->getAttribute('questions_count');

                        if( ($count + $quiz_old_questions->count()) > $max_questions ){
                            Notification::make()
                                ->title('error')
                                ->body('maximum questions count exceeded (' . $max_questions . ')' )
                                ->warning()
                                ->send();

                            return;
                        }
                        $this->record->questions()->syncWithoutDetaching($available_questions->random($count));
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DetachAction::make(),
            ])
            ->bulkActions([

            ]);
    }
}
