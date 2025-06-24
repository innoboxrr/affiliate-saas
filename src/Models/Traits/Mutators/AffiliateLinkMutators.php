<?php

namespace Innoboxrr\AffiliateSaas\Models\Traits\Mutators;

trait AffiliateLinkMutators
{

	public function getWorkspaceIdAttribute()
    {
        return $this->affiliate?->workspace_id;
    }

}