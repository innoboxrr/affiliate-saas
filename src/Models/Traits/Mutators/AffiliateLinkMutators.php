<?php

namespace Innoboxrr\AffiliateSaas\Models\Traits\Mutators;

trait AffiliateLinkMutators
{

	public function getWorkspaceIdAttribute()
    {
        return $this->program?->workspace_id;
    }

}