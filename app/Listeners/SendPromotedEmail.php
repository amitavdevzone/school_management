<?php

namespace App\Listeners;

use App\Events\PromoteStudent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendPromotedEmail
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
        logger('Sending email to student ' . $event->student->name);
    }
}
