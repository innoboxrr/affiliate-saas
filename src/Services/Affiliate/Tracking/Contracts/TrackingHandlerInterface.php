<?php

namespace Innoboxrr\AffiliateSaas\Services\Affiliate\Tracking\Contracts;

use Illuminate\Http\Request;

interface TrackingHandlerInterface
{
    public function handle(Request $request): mixed;
}
