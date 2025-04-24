<?php

namespace App\Filament\Resources;

use App\Enums\DifficultyLevel;
use App\Filament\Resources\QuestionResource\Pages;
use App\Filament\Resources\QuestionResource\RelationManagers;
use App\Models\Question;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class QuestionResource extends Resource
{
    protected static ?string $model = Question::class;

    protected static ?string $navigationIcon = 'heroicon-o-question-mark-circle';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('question information')
                    ->schema([
                        Forms\Components\Hidden::make('teacher_id')
                            ->required()
                            ->default(Auth::id()),
                        Forms\Components\Select::make('subject_id')
                            ->required()
                            ->relationship('subject', 'name'),
                        Forms\Components\RichEditor::make('text')
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\Select::make('difficulty_level')
                            ->required()
                            ->options(DifficultyLevel::toArray(true))
                            ->enum(DifficultyLevel::class),
                    ]),
                Forms\Components\Section::make('choices')
                    ->schema([
                        Forms\Components\Repeater::make('choices')
                            ->minItems(1)
                            ->schema([
                                Forms\Components\TextInput::make('text')
                                    ->required(),
                                Forms\Components\Radio::make('is_correct')
                                    ->options([
                                        false => 'wrong',
                                        true => 'correct',
                                    ])->default(false),
                            ])
                    ])
            ]);
    }



    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->prefix("#")
                    ->badge()
                    ->sortable(),
                Tables\Columns\TextColumn::make('subject.name')
                    ->badge()
                    ->searchable()
                    ->color(Color::Green),
                Tables\Columns\TextColumn::make('created_at')
                    ->badge()
                    ->dateTime(),
                Tables\Columns\SelectColumn::make('difficulty_level')
                    ->options(DifficultyLevel::toArray(true)),
                Tables\Columns\TextColumn::make('correct_answer')
                    ->default('no correct answer')
                    ->formatStateUsing(fn(Question $record) => $record->choices()->where('is_correct', true)->first()->text)
                    ->badge(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListQuestions::route('/'),
            'create' => Pages\CreateQuestion::route('/create'),
            'edit' => Pages\EditQuestion::route('/{record}/edit'),
        ];
    }
}
