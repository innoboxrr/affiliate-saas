<?php

namespace Innoboxrr\AffiliateSaas\Services\Affiliate\Tracking\Processors;

use Illuminate\Http\Request;
use Innoboxrr\AffiliateSaas\Models\AffiliateClick;

class ConversionProcessor
{
    protected AffiliateClick $click;
    protected Request $request;

    public function __construct(AffiliateClick $click, Request $request)
    {
        $this->click = $click;
        $this->request = $request;
    }

    public function process(): void
    {
        // Aquí podrías crear la conversión asociada
        $this->click->conversion()->create([
            'amount' => $this->request->input('amount'),
            'currency' => $this->request->input('currency', 'USD'),
            'external_order_id' => $this->request->input('order_id'),
            'external_user_id' => $this->request->input('user_id'),
        ]);
    }
}
