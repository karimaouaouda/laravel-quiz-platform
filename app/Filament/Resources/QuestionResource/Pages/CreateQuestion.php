<?php

namespace App\Filament\Resources\QuestionResource\Pages;

use App\Enums\QuestionType;
use App\Filament\Resources\QuestionResource;
use App\Models\Question;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CreateQuestion extends CreateRecord
{
    protected static string $resource = QuestionResource::class;

    protected function handleRecordCreation(array $data): Model
    {

        $question_type = $data['question_type'];
        $data['teacher_id'] = Auth::id();
        if( $question_type == QuestionType::TRUE_FALSE->value ) {
            $choices = [
                [
                    'text' => 'true',
                    'is_correct' => $data['is_true'],
                ],
                [
                    'text' => 'false',
                    'is_correct' => !$data['is_true'],
                ]
            ];
        }else if($question_type == QuestionType::ONE_CHOICE->value){
            $true_ones = array_filter($data['choices'], function($choice){
                return $choice['is_correct'];
            });

            $validation = Validator::make([
                'choices' => $true_ones,
            ], [
                'choices' => ['array', 'size:1']
            ], [
                'choices' => 'choices must have one correct answer'
            ]);

            if( $validation->fails() ){
                Notification::make()
                    ->title('error in choices')
                    ->body($validation->errors()->first('choices'))
                    ->danger()
                    ->send();
                throw new ValidationException($validation);
            }
            $choices = $data['choices'];
        }else{
            $choices = $data['choices'];
        }

        $model = Question::query()->create($data);
        $model->save();

        foreach ($choices as $index => $choice) {
            $model->choices()->create($choice);
        }

        return $model;
    }
}
