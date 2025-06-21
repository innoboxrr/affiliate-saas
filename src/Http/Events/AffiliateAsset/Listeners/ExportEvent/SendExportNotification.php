<?php

namespace Innoboxrr\AffiliateSaas\Http\Events\AffiliateAsset\Listeners\ExportEvent;

use Innoboxrr\AffiliateSaas\Notifications\AffiliateAsset\ExportNotification;
use Innoboxrr\AffiliateSaas\Http\Events\AffiliateAsset\Events\ExportEvent;
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