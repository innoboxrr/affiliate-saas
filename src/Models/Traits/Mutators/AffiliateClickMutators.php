<?php

namespace Innoboxrr\AffiliateSaas\Models\Traits\Mutators;

trait AffiliateClickMutators
{

	public function getWorkspaceIdAttribute()
    {
        return $this->link?->program?->workspace_id;
    }

}