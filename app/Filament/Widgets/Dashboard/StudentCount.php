<?php

namespace App\Filament\Widgets\Dashboard;

use App\Models\Certificate;
use App\Models\Student;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StudentCount extends BaseWidget
{
    protected static ?string $pollingInterval = null;

    protected function getCards(): array
    {
        return [
            Card::make('Student count', Student::count())
                ->icon('heroicon-o-users')
                ->description('The total count of students in the system')
                ->descriptionIcon('heroicon-o-trending-up')
                ->descriptionColor('success')
                ->color('success')
                ->chart([2, 10, 3, 12, 1, 14, 10, 1, 2, 10])
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                ]),
            Card::make('Certificate count', Certificate::count())
                ->icon('heroicon-o-book-open')
                ->color('danger')
                ->chart([1, 2, 13, 5, 9, 1, 2, 5, 0])
                ->extraAttributes([
                    'class' => 'cursor-pointer',
                ])
                ->description('The total count of certificates in the system')
                ->descriptionIcon('heroicon-o-trending-up'),
        ];
    }
}
