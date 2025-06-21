<?php

namespace Innoboxrr\AffiliateSaas\Http\Events\Affiliate\Listeners\ExportEvent;

use Innoboxrr\AffiliateSaas\Notifications\Affiliate\ExportNotification;
use Innoboxrr\AffiliateSaas\Http\Events\Affiliate\Events\ExportEvent;
use Illuminate\Support\Facades\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendExportNotification
{

    public function __construct()
    {
        //
    }

    public function handle(ExportEvent $event)
    {
        $event->user->notify((new ExportNotification($event->data))->locale($event->locale));
    }

}