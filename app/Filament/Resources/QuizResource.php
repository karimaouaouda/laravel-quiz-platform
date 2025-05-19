<?php

namespace App\Filament\Resources;

use App\Enums\DifficultyLevel;
use App\Enums\QuizStatus;
use App\Filament\Resources\QuizResource\Pages;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\Subject;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\IconPosition;
use Filament\Tables;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Table;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Features\SupportConsoleCommands\Commands\CopyCommand;

class QuizResource extends Resource
{
    protected static ?string $model = Quiz::class;

    protected Forms\Components\Wizard\Step $questions;

    protected static ?string $navigationIcon = 'heroicon-o-queue-list';

    public static function getEloquentQuery(): Builder
    {
        return Quiz::query()->where('teacher_id', auth()->id());
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Hidden::make('teacher_id')
                    ->default(Auth::id()),
                Forms\Components\Select::make('subject_id')
                    ->label('Subject')
                    ->options(function(){
                        return auth()->user()->subjects()->pluck('name', 'id');
                    })
                    ->required(),
                Forms\Components\TextInput::make('code')
                    ->label('Unique Code')
                    ->default(Str::random(10))
                    ->suffixAction(function ($state){
                        return Forms\Components\Actions\Action::make('copy')
                            ->icon('heroicon-o-clipboard-document')
                            ->action(function($livewire) use ($state){
                                try{
                                    $livewire->js('navigator.clipboard.writeText("'.$state.'")');
                                    Notification::make()
                                        ->title('copied to clipboard')
                                        ->color(Color::Green)
                                        ->body('quiz code copied to clipboard')
                                        ->send();

                                }catch(\Exception $e){
                                    Notification::make()
                                        ->title('Error')
                                        ->color(Color::Red)
                                        ->body($e->getMessage())
                                        ->send();
                                }
                            });
                    })
                    ->hint('students will use that code to access to quiz')
                    ->required(),
                Forms\Components\Select::make('difficulty_level')
                    ->live()
                    ->options(DifficultyLevel::toArray(true))
                    ->default(DifficultyLevel::EASY->value)
                    ->required(),
                Forms\Components\TextInput::make('title')
                    ->placeholder('the quiz title')
                    ->required(),
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->hint('the quiz description to show in quiz card')
                    ->placeholder('the quiz description'),
                Forms\Components\DatePicker::make('end_at')
                    ->default(now()->addDay())
                    ->minDate(now()->addDay())
                    ->required(),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->prefix("#")
                    ->badge(),
                Tables\Columns\TextColumn::make('subject.name')
                    ->badge()
                    ->searchable(),
                Tables\Columns\TextColumn::make('code')
                    ->icon('heroicon-o-clipboard-document')
                    ->iconPosition(IconPosition::After)
                    ->action(function ($livewire, $state){
                        try{
                            $livewire->js('navigator.clipboard.writeText("'.$state.'")');
                            Notification::make()
                                ->title('copied to clipboard')
                                ->color(Color::Green)
                                ->body('quiz code copied to clipboard')
                                ->send();

                        }catch(\Exception $e){
                            Notification::make()
                                ->title('Error')
                                ->color(Color::Red)
                                ->body($e->getMessage())
                                ->send();
                        }
                    })
                    ->badge(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->words(5)
                    ->tooltip(fn($state) => $state),
                Tables\Columns\TextColumn::make('difficulty_level')
                    ->color(Color::Green)
                    ->badge(),
                    SelectColumn::make('status')
                        ->options([
                            QuizStatus::ACTIVE->value => 'active',
                            QuizStatus::INACTIVE->value => 'inactive',
                        ]),
                Tables\Columns\TextColumn::make('end_at')
                    ->dateTime()
                    ->badge(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\Action::make('questions')
                    ->icon('heroicon-o-numbered-list')
                    ->color(Color::Red)
                    ->url(fn(Quiz $record) => route('filament.teacher.resources.quizzes.questions', ['record' => $record->getAttribute('id')]))
                    ->openUrlInNewTab()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListQuizzes::route('/'),
            'create' => Pages\CreateQuiz::route('/create'),
            'edit' => Pages\EditQuiz::route('/{record}/edit'),
            'questions' => Pages\ManageQuizQuestions::route('/{record}/questions'),
        ];
    }
}
