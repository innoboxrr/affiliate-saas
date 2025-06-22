<?php

namespace Innoboxrr\AffiliateSaas\Models\Traits\Mutators;

trait AffiliatePayoutMutators
{

	public function getWorkspaceIdAttribute()
    {
        return $this->affiliate?->workspace_id;
    }

}