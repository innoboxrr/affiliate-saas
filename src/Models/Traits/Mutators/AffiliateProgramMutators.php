<?php

namespace Innoboxrr\AffiliateSaas\Models\Traits\Mutators;

trait AffiliateProgramMutators
{
    public function getIsTestAttribute()
    {
        return filter_var($this->getPayload('is_test', false), FILTER_VALIDATE_BOOLEAN);
    }

    public function getCurrencyAttribute()
    {
        return $this->getPayload('currency');
    }

    public function getAllowAffiliateRegisterAttribute()
    {
        return $this->getPayload('allow_self_registration', false);
    }

	public function getAffiliateRegisterUrlAttribute()
    {
        if($this->allow_affiliate_register) {
            return url('affiliate/' . $this->id . '/register');
        }
    }

    public function getPayoutThresholdDaysAttribute()
    {
        return (int) $this->getPayload('payout_threshold_days', 90);
    }

}