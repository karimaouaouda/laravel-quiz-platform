<?php

namespace App\Filament\Student\Widgets;

use Filament\Support\Colors\Color;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class GlobalStats extends BaseWidget
{
    protected static bool $isLazy = false;
    protected function getStats(): array
    {
        return [
            $this->getSubmissionsStat(),
            $this->getAnswersStat(),
            $this->getTotalTimeSpentStat()
        ];
    }

    private function getSubmissionsStat(): Stat
    {
        return Stat::make('submissions', 10)
            ->label('Total submissions')
            ->description('Total submissions')
            ->color('primary')
            ->chart([2, 1.5, 1.8, 1.2, 1, 0.8, 1.2, 1.3, 1])
            ->icon('heroicon-o-clipboard-document-check');

    }

    private function getAnswersStat(): Stat
    {
        return Stat::make('answers', 10)
            ->label('Total answers')
            ->description('Total answers')
            ->color(Color::Green)
            ->chart(array_reverse([2, 1.5, 1.8, 1.2, 1, 0.8, 1.2, 1.3, 1]))
            ->icon('heroicon-o-check-badge');
    }

    private function getTotalTimeSpentStat(): Stat
    {
        return Stat::make('time_spent', 10)
            ->label('Total time spent')
            ->description('Total time spent')
            ->color(Color::Blue)
            ->chart([2, 1.5, 1.8, 1.2, 1, 0.8, 1.2, 1.3, 1])
            ->icon('heroicon-o-clock');
    }
}
