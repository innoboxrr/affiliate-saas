<?php

namespace Innoboxrr\AffiliateSaas\Models\Traits\Mutators;

trait AffiliateProgramMutators
{

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

}