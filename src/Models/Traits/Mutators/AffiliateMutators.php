<?php

namespace Innoboxrr\AffiliateSaas\Models\Traits\Mutators;

trait AffiliateMutators
{

	public function getWorkspaceIdAttribute()
    {
        return $this->program?->workspace_id;
    }

    public function getCommissionTypeAttribute()
    {
        if($this->getPayload('commission.use_custom', false)) {
            return $this->getPayload('commission.type', 'percentage');
        } else {
            return $this->program?->getPayload('commission_type', 'percentage');
        }
    }

    public function getCommissionValueAttribute()
    {
        if($this->getPayload('commission.use_custom', false)) {
            return (float) $this->getPayload('commission.value', 0);
        } else {
            return (float) $this->program?->getPayload('default_commission', 0);
        }
    }

}