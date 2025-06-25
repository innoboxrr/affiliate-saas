<?php

namespace Innoboxrr\AffiliateSaas\Models\Traits\Operations;

trait AffiliateOperations
{

    public function buildPayload()
    {
        return [
            'user' => [
                'name' => $this->meta('user_name'),
                'email' => $this->meta('user_email'),
                'phone' => $this->meta('user_phone'),
            ],
            'address' => [
                'street'  => $this->meta('address_street'),
                'city'    => $this->meta('address_city'),
                'state'   => $this->meta('address_state'),
                'country' => $this->meta('address_country'),
                'zip'     => $this->meta('address_zip'),
            ],
            'links' => [
                'website'   => $this->meta('links_website'),
                'facebook'  => $this->meta('links_facebook'),
                'twitter'   => $this->meta('links_twitter'),
                'instagram' => $this->meta('links_instagram'),
                'linkedin'  => $this->meta('links_linkedin'),
                'youtube'   => $this->meta('links_youtube'),
                'tiktok'    => $this->meta('links_tiktok'),
            ],
            'financial' => [
                'affiliate_type'     => $this->meta('financial_affiliate_type'),
                'tax_id'             => $this->meta('financial_tax_id'),
                'comercial_name'     => $this->meta('financial_comercial_name'),
                'payment_method'     => $this->meta('financial_payment_method'),
                'paypal_email'       => $this->meta('financial_paypal_email'),
                'bank_name'          => $this->meta('financial_bank_name'),
                'account_number'     => $this->meta('financial_account_number'),
                'account_holder'     => $this->meta('financial_account_holder'),
                'stripe_account_id'  => $this->meta('financial_stripe_account_id'),
            ],
            'commission' => [
                'use_custom' => $this->meta('use_custom_commission', false),
                'type' => $this->meta('commission_type', 'percentage'), // 'percentage' or 'fixed'
                'value' => $this->meta('commission_value', 0),
            ]
        ];
    }

    public function updatePayload()
    {
        $this->payload = $this->buildPayload();
        return $this->save();
    }

    public function calculateCommission($amount, $currency = 'USD')
    {
        $commissionType = $this->commission_type;
        $commissionValue = $this->commission_value;

        if ($commissionType === 'percentage') {
            return ($amount * $commissionValue) / 100;
        } elseif ($commissionType === 'fixed') {
            return $commissionValue;
        }

        return 0.00;
    }

}
