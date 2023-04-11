<?php

namespace App\Filament\Resources\StudentResource\Widgets;

use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Widgets\Widget;
use Illuminate\Database\Eloquent\Model;

class StudentAttendanceWidget extends Widget
{
    protected static string $view = 'filament.resources.student-resource.widgets.student-attendance-widget';

    public ?Model $record = null;

    public int $count = 0;

    protected $listeners = [
        'undoIncrement' => 'decrementCount'
    ];

    public function incrementCount(): void
    {
        $this->count++;

        Notification::make()
            ->title('Value incremented!')
            ->body('**Congratulations**, you have incremented the value.')
            ->icon('heroicon-o-users')
            ->iconColor('success')
            ->actions([
                Action::make('View')
                    ->color('success')
                    ->url(route('filament.pages.dashboard'), shouldOpenInNewTab: true),
                Action::make('Undo')
                    ->button()
                    ->color('danger')->emit('undoIncrement'),
            ])
            ->send();
    }

    public function decrementCount(): void
    {
        $this->count !== 0 && $this->count--;
    }
}
