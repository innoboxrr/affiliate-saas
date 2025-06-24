<?php

namespace Innoboxrr\AffiliateSaas\Http\Controllers;

use Illuminate\Http\Request;
use Innoboxrr\AffiliateSaas\Services\Affiliate\Tracking\TrackingService;

class AffiliateTrackingController
{
    protected TrackingService $service;

    public function __construct(TrackingService $service)
    {
        $this->service = $service;
    }

    public function handle(Request $request, $event = 'click')
    {
        return $this->service->handle($event, $request);
    }
}
