<?php

namespace Innoboxrr\AffiliateSaas\Models\Traits\Mutators;

trait AffiliateConversionMutators
{

	public function getWorkspaceIdAttribute()
    {
        return $this->link?->program?->workspace_id;
    }

}