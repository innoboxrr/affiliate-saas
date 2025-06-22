<?php

namespace Innoboxrr\AffiliateSaas\Models\Traits\Operations;

trait AffiliateProgramOperations
{

    public function buildPayload()
    {
        return [
            'test_mode' => filter_var($this->meta('test_mode', false), FILTER_VALIDATE_BOOLEAN),
            'tracking_model' => $this->meta('tracking_model', 'cookie'),
            'cookie_path' => $this->meta('cookie_path', 'https://google.com'), // Default to root path
            'cookie_lifetime' => $this->meta('cookie_lifetime', 30), // Default to 30 days
            'default_commission' => $this->meta('default_commission', 0.00), // Default to 0.00
        ];
    }

    public function updatePayload()
    {

        $this->payload = $this->buildPayload();

        return $this->save();

    }

}
