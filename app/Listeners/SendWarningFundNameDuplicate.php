<?php

namespace App\Listeners;

use App\Events\FundNameDuplicate;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class SendWarningFundNameDuplicate
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     */
    public function handle(FundNameDuplicate $event): void
    {
        Log::warning('A fund of id #'.$event->fund->id.' was created with duplicate name or alias for the name: '.$event->fund->name);

        //maybe send slack notification, email, SMS, etc
    }
}
