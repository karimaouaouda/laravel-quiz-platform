<?php

namespace App\Filament\Student\Resources;

use App\Filament\Student\Resources\SubmissionResource\Pages;
use App\Filament\Student\Resources\SubmissionResource\RelationManagers;
use App\Models\Submission;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SubmissionResource extends Resource
{
    protected static ?string $model = Submission::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canDelete(Model $record): bool
    {
        return false;
    }

    public static function canEdit(Model $record): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->heading("Your submission to quizzes")
            ->description('here you will track your submissions')
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->prefix("#")
                    ->badge()
                    ->sortable(),
                Tables\Columns\TextColumn::make('quiz.teacher.name')
                    ->color(Color::Indigo)
                    ->badge(),
                Tables\Columns\TextColumn::make('quiz.title')
                    ->searchable()
                    ->words(5)
                    ->tooltip(fn($state) => $state)
                    ->sortable(),
                Tables\Columns\TextColumn::make('quiz.subject.name')
                    ->badge()
                    ->searchable(),
                Tables\Columns\TextColumn::make('score')
                    ->suffix('%')
                    ->badge()
                    ->color(function($state){
                        if( $state < 50 )
                            return Color::Red;
                        if ($state < 75)
                            return Color::Green;
                        return Color::Blue;
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('submit at')
                    ->dateTime()
                    ->badge()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
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
            'index' => Pages\ListSubmissions::route('/'),
            'create' => Pages\CreateSubmission::route('/create'),
            'edit' => Pages\EditSubmission::route('/{record}/edit'),
        ];
    }
}
