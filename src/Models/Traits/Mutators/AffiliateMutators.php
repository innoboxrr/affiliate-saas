<?php

namespace Innoboxrr\AffiliateSaas\Models\Traits\Mutators;

trait AffiliateMutators
{

	public function getWorkspaceIdAttribute()
    {
        return $this->program->workspace_id;
    }

}