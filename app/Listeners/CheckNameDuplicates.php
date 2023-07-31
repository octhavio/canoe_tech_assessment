<?php

namespace App\Listeners;

use App\Events\NewFundCreated;
use App\Events\FundNameDuplicate;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

use App\Models\Fund;
use App\Models\FundAlias;


class CheckNameDuplicates
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
    public function handle(NewFundCreated $event): void
    {
        
        $checkFundNames = Fund::where('name',$event->fund->name)->count();
        $checkFundAliases = FundAlias::where('alias',$event->fund->name)->count();



        if($checkFundNames  || $checkFundAliases){
            // Log::warning('dispatching to admins that duplicate was found.');

            FundNameDuplicate::dispatch($event->fund);

        }


    }
}
