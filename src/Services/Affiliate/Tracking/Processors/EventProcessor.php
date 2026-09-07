<?php

namespace Innoboxrr\AffiliateSaas\Services\Affiliate\Tracking\Processors;

use Innoboxrr\AffiliateSaas\Models\AffiliateClick;
use Illuminate\Http\Request;

class EventProcessor
{
    protected AffiliateClick $click;

    public function __construct(AffiliateClick $click)
    {
        $this->click = $click;
    }

    public function process(Request $request = null): void
    {
        $payload = $request ? $request->all() : [];

        $this->click->setMeta('custom_event', json_encode([
            'payload' => $payload,
            'timestamp' => now()->toISOString(),
            'ip' => $request?->ip(),
        ]));
    }
}
