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
            
            'commission_type' => $this->meta('commission_type', 'percentage'), // percentage or fixed
            'default_commission' => $this->meta('default_commission', 0.00), // Default to 0.00

            'currency' => $this->meta('currency', 'USD'), // Default to USD
            'payout_threshold' => (float) $this->meta('payout_threshold', 100.00), // Default to 100.00
            
            'allow_frontend_conversions' => filter_var($this->meta('allow_frontend_conversions', false), FILTER_VALIDATE_BOOLEAN),
            'allowed_urls' => $this->meta('allowed_urls'), // Default to an empty array

            'registration_title' => $this->meta('registration_title', 'Join our Affiliate Program'),
            'registration_description' => $this->meta('registration_description', 'Sign up to become an affiliate and start earning commissions.'),
            'registration_image' => $this->meta('registration_image', null), // Default to null
            'allow_self_registration' => filter_var($this->meta('allow_self_registration', false), FILTER_VALIDATE_BOOLEAN),
        ];
    }

    public function updatePayload()
    {

        $this->payload = $this->buildPayload();

        return $this->save();

    }

}
