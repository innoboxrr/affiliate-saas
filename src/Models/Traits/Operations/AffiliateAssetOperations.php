<?php

namespace Innoboxrr\AffiliateSaas\Models\Traits\Operations;

trait AffiliateAssetOperations
{

    public function buildPayload()
    {

        return [
            'usage_notes' => $this->meta('usage_notes'),
        ];

    }

    public function updatePayload()
    {

        $this->payload = $this->buildPayload();

        return $this->save();

    }

}
