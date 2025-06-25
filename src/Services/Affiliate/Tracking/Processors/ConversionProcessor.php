<?php

namespace Innoboxrr\AffiliateSaas\Services\Affiliate\Tracking\Processors;

use Illuminate\Http\Request;
use Innoboxrr\AffiliateSaas\Enums\AffiliateConversion\EventType;
use Innoboxrr\AffiliateSaas\Enums\AffiliateConversion\Status;
use Innoboxrr\AffiliateSaas\Models\Affiliate;
use Innoboxrr\AffiliateSaas\Models\AffiliateClick;
use Innoboxrr\AffiliateSaas\Models\AffiliateProgram;

class ConversionProcessor
{
    protected Affiliate $affiliate;
    protected AffiliateClick $click;
    protected AffiliateProgram $program;
    protected Request $request;

    public function __construct(AffiliateClick $click, Request $request)
    {
        $this->click = $click;
        $this->program = $click->link->program;
        $this->affiliate = $click->link->affiliate;
        $this->request = $request;
    }

    public function process(): void
    {
        $eventType = $this->request->input('event_type');
        $amount = (float) $this->request->input('amount');
        $currency = $this->request->input('currency');
        
        $this->click->conversions()->create([
            'status' => $eventType === EventType::CLIENT_CONVERSION->value ? Status::PENDING->value : Status::APPROVED->value,
            'amount' => $amount,
            'currency' => $this->request->input('currency'),
            'commission' => $this->affiliate->calculateCommission($amount, $currency),
            'event_type' => $eventType,
            'payload' => $this->request->all(),
            'is_test' => $this->request->input('is_test', false) || $this->program->is_test,
            'approved_at' => $eventType === EventType::CLIENT_CONVERSION->value ? null : now(),
            'external_order_id' => $this->request->input('order_id'),
            'external_user_id' => $this->request->input('user_id'),
            'affiliate_link_id' => $this->click->affiliate_link_id
        ]);
    }
}
