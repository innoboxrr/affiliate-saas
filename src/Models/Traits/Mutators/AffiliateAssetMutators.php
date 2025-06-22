<?php

namespace Innoboxrr\AffiliateSaas\Models\Traits\Mutators;

use Illuminate\Support\Facades\Storage;
use Innoboxrr\AffiliateSaas\Enums\AffiliateAsset\Type;

trait AffiliateAssetMutators
{

	public function getWorkspaceIdAttribute()
    {
        return $this->affiliateProgram?->workspace_id;
    }

    public function getAssetUrlAttribute()
    {
        if ($this->type === Type::URL) {
            return $this->url;
        }

        if (Storage::disk('s3')->exists($this->url)) {
            return Storage::disk('s3')->temporaryUrl(
                $this->url,
                now()->addMinutes(5)
            );
        }

        return null;
    }

}