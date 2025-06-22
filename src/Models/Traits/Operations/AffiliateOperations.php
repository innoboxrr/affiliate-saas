<?php

namespace Innoboxrr\AffiliateSaas\Models\Traits\Operations;

trait AffiliateOperations
{

    public function buildPayload()
    {

        return [
            'name' => $this->meta('name'),
            'email' => $this->meta('email'),
            'phone' => $this->meta('phone'),
            'address' => $this->meta('address'),
            'city' => $this->meta('city'),
            'state' => $this->meta('state'),
            'country' => $this->meta('country'),
            'zip' => $this->meta('zip'),
            'website' => $this->meta('website'),
            'facebook' => $this->meta('facebook'),
            'twitter' => $this->meta('twitter'),
            'instagram' => $this->meta('instagram'),
            'linkedin' => $this->meta('linkedin'),
            'youtube' => $this->meta('youtube'),
            'tiktok' => $this->meta('tiktok'),
            'payment_method' => $this->meta('payment_method'),
            'payment_data' => $this->meta('payment_data'),
            'affiliate_type' => $this->meta('affiliate_type'),
        ];

    }

    public function updatePayload()
    {

        $this->payload = $this->buildPayload();

        return $this->save();

    }

}
