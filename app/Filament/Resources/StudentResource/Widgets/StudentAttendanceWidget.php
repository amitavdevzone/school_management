<?php

namespace App\Filament\Resources\StudentResource\Widgets;

use Filament\Widgets\Widget;
use Illuminate\Database\Eloquent\Model;

class StudentAttendanceWidget extends Widget
{
    protected static string $view = 'filament.resources.student-resource.widgets.student-attendance-widget';

    public ?Model $record = null;

    public int $count = 0;

    public function incrementCount()
    {
        $this->count++;
    }
}
