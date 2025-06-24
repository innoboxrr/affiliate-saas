<?php

namespace Innoboxrr\AffiliateSaas\Services\Affiliate\Tracking\Processors;

use Innoboxrr\AffiliateSaas\Models\AffiliateClick;

class EventProcessor
{
    protected AffiliateClick $click;

    public function __construct(AffiliateClick $click)
    {
        $this->click = $click;
    }

    public function process(): void
    {
        // Aquí podrías almacenar logs de eventos personalizados, eventos analíticos, etc.
    }
}
