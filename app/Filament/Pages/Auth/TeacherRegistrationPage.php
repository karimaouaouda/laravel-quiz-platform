<?php

namespace App\Filament\Pages\Auth;

use Filament\Forms\Components\Hidden;
use Filament\Forms\Form;
use Filament\Pages\Auth\Register;

class TeacherRegistrationPage extends Register
{
    /**
     * @return array<int | string, string | Form>
     */
    protected function getForms(): array
    {
        return [
            'form' => $this->form(
                $this->makeForm()
                    ->schema([
                        $this->getRoleFormComponent(),
                        $this->getNameFormComponent(),
                        $this->getEmailFormComponent(),
                        $this->getPasswordFormComponent(),
                        $this->getPasswordConfirmationFormComponent(),
                    ])
                    ->statePath('data'),
            ),
        ];
    }

    private function getRoleFormComponent(): Hidden
    {
        return Hidden::make('role')
            ->default('teacher');
    }
}
