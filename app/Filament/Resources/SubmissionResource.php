<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubmissionResource\Pages;
use App\Filament\Resources\SubmissionResource\RelationManagers;
use App\Models\Submission;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SubmissionResource extends Resource
{
    protected static ?string $model = Submission::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit(\Illuminate\Database\Eloquent\Model $record): bool
    {
        return false;
    }

    public static function canDelete(\Illuminate\Database\Eloquent\Model $record): bool
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
            ->columns([
                TextColumn::make('id')
                    ->prefix('#')
                    ->badge()
                    ->color(Color::Green),
                TextColumn::make('student.name')
                    ->searchable()
                    ->icon('heroicon-o-user'),
                TextColumn::make('quiz.title')
                    ->searchable()
                    ->icon('heroicon-o-book-open'),
                TextColumn::make('score')
                    ->sortable()
                    ->icon('heroicon-o-star')
                    ->badge()
                    ->color(Color::Blue)
                    ->suffix(function($record){
                        return '%' . ' (' . $record->correct_answers_count . ' / ' . $record->answers()->count() . ')';
                    }),
                TextColumn::make('time_taken')
                    ->default(0)
                    ->formatStateUsing(function($record){
                        return $record->answers()->sum('answer_duration') . 's';
                    })
                    ->sortable()
                    ->icon('heroicon-o-clock'),
                TextColumn::make('created_at')
                    ->sortable()
                    ->icon('heroicon-o-clock')
                    ->dateTime('d-m-Y H:i'),
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
