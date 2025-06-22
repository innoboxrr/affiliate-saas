<?php

namespace Innoboxrr\AffiliateSaas\Models\Traits\Relations;

use Innoboxrr\AffiliateSaas\Models\AffiliateAssetMeta;
use Innoboxrr\AffiliateSaas\Models\AffiliateProgram;
// use \Znck\Eloquent\Traits\BelongsToThrough; // Docs: https://github.com/staudenmeir/belongs-to-through
// use \Staudenmeir\EloquentHasManyDeep\HasRelationships; // Docs: https://github.com/staudenmeir/eloquent-has-many-deep

trait AffiliateAssetRelations
{
    public function metas()
    {
        return $this->hasMany(AffiliateAssetMeta::class, 'affiliate_asset_id');
    }

    public function affiliateProgram()
    {
        return $this->belongsTo(AffiliateProgram::class, 'affiliate_program_id');
    }
}