<?php

namespace App\Filament\Pages\Auth\Admin;

use Filament\Forms\Components\Hidden;
use Filament\Pages\Auth\Register as AuthRegister;

class Register extends AuthRegister
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
                        Hidden::make('role')
                            ->default('admin'),
                        $this->getNameFormComponent(),
                        $this->getEmailFormComponent(),
                        $this->getPasswordFormComponent(),
                        $this->getPasswordConfirmationFormComponent(),
                    ])
                    ->statePath('data'),
            ),
        ];
    }
}
