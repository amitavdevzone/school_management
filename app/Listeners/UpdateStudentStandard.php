<?php

namespace App\Listeners;

use App\Events\PromoteStudent;

class UpdateStudentStandard
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PromoteStudent $event): void
    {
        $event->student->standard_id += 1;
        $event->student->save();
    }
}
