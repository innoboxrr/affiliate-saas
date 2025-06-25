<?php

namespace Innoboxrr\AffiliateSaas\Services\Affiliate\Tracking\Handlers;

use Illuminate\Http\Request;
use Innoboxrr\AffiliateSaas\Services\Affiliate\Tracking\Contracts\TrackingHandlerInterface;
use Innoboxrr\AffiliateSaas\Services\Affiliate\Tracking\Validators\EventValidator;
use Innoboxrr\AffiliateSaas\Services\Affiliate\Tracking\Processors\EventProcessor;
use Innoboxrr\AffiliateSaas\Services\Affiliate\Tracking\Responders\EventResponder;

class EventHandler implements TrackingHandlerInterface
{
    public function handle(Request $request): mixed
    {
        $validator = new EventValidator($request);
        if ($response = $validator->fails()) {
            return $response;
        }

        (new EventProcessor($validator->getValidatedEntity()))->process();

        return EventResponder::success();
    }
}
