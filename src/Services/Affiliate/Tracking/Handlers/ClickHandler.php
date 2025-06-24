<?php

namespace Innoboxrr\AffiliateSaas\Services\Affiliate\Tracking\Handlers;

use Illuminate\Http\Request;
use Innoboxrr\AffiliateSaas\Services\Affiliate\Tracking\Contracts\TrackingHandlerInterface;
use Innoboxrr\AffiliateSaas\Services\Affiliate\Tracking\Validators\ClickValidator;
use Innoboxrr\AffiliateSaas\Services\Affiliate\Tracking\Processors\ClickProcessor;
use Innoboxrr\AffiliateSaas\Services\Affiliate\Tracking\Responders\ClickResponder;

class ClickHandler implements TrackingHandlerInterface
{
    public function handle(Request $request): mixed
    {
        $validator = new ClickValidator($request);
        if ($response = $validator->fails()) {
            return $response;
        }

        $clickId = (new ClickProcessor($validator->getAffiliateLink(), $request))->process();

        return ClickResponder::success($clickId, $validator->getAffiliateLink()->target);
    }
}
