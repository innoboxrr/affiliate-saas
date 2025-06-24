<?php

namespace Innoboxrr\AffiliateSaas\Services\Affiliate\Tracking\Handlers;

use Illuminate\Http\Request;
use Innoboxrr\AffiliateSaas\Services\Affiliate\Tracking\Contracts\TrackingHandlerInterface;
use Innoboxrr\AffiliateSaas\Services\Affiliate\Tracking\Validators\ConversionValidator;
use Innoboxrr\AffiliateSaas\Services\Affiliate\Tracking\Processors\ConversionProcessor;
use Innoboxrr\AffiliateSaas\Services\Affiliate\Tracking\Responders\ConversionResponder;

class ConversionHandler implements TrackingHandlerInterface
{
    public function handle(Request $request): mixed
    {
        $validator = new ConversionValidator($request);
        if ($response = $validator->fails()) {
            return $response;
        }

        $processor = new ConversionProcessor($validator->getClick(), $request);
        $processor->process();

        return ConversionResponder::success();
    }
}
