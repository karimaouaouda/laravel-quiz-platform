<?php

namespace App\Filament\Widgets;

use App\Models\Group;
use App\Models\User;
use Filament\Support\Colors\Color;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;


class GlobalStats extends BaseWidget
{
    protected static bool $isLazy = false;
    protected function getStats(): array
    {
        return [
            $this->makeQuizzesStat(),
            $this->makeStudentStat(),
            $this->makeSubjectsStat()
        ];
    }

    private function makeSubjectsStat(): Stat
    {
        return Stat::make('subjects', Auth::user()->subjects()->count())
            ->label('Subjects')
            ->color(Color::Red)
            ->icon('heroicon-s-rectangle-stack')
            ->chart([2, 1.5, 1.8, 1.2, 1, 0.8, 1.2, 1.3, 1])
            ->chartColor(Color::Red)
            ->description('Total number of subjects you created');
    }
    private function makeQuizzesStat(): Stat
    {
        return Stat::make('quizzes', Auth::user()->quizzes()->count())
            ->color(Color::Green)
            ->icon('heroicon-s-queue-list')
            ->chart([2, 1.5, 1.8, 1.2, 1, 0.8, 1.2, 1.3, 1])
            ->chartColor(Color::Green)
            ->descriptionIcon('heroicon-s-clipboard-document')
            ->description('amount of quizzes you created');
    }

    private function makeStudentStat(): Stat
    {
        return Stat::make('students', User::query()->where('role', 'student')->count())
            ->color(Color::Blue)
            ->icon('heroicon-s-users')
            ->chart(array_reverse([2, 1.5, 1.8, 1.2, 1, 0.8, 1.2, 1.3, 1]))
            ->chartColor(Color::Blue)
            ->descriptionIcon('heroicon-s-clipboard-document-check')
            ->description('amount of students answer your quizzes');
    }
}
