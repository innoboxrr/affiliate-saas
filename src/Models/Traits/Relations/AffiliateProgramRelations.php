<?php

namespace Innoboxrr\AffiliateSaas\Models\Traits\Relations;

use Innoboxrr\AffiliateSaas\Models\AffiliateProgramMeta;
use Innoboxrr\AffiliateSaas\Models\AffiliateLink;
use Innoboxrr\AffiliateSaas\Models\AffiliateAsset;
use Innoboxrr\AffiliateSaas\Models\Affiliate;
use \Znck\Eloquent\Traits\BelongsToThrough; // Docs: https://github.com/staudenmeir/belongs-to-through
// use \Staudenmeir\EloquentHasManyDeep\HasRelationships; // Docs: https://github.com/staudenmeir/eloquent-has-many-deep

trait AffiliateProgramRelations
{
    use BelongsToThrough; 

    public function metas()
    {
        return $this->hasMany(AffiliateProgramMeta::class, 'affiliate_program_id');
    }

    public function workspace()
    {
        return $this->belongsTo(config('affiliate.workspace_class'));
    }

    public function links()
    {
        return $this->hasMany(AffiliateLink::class);
    }

    public function assets()
    {
        return $this->hasMany(AffiliateAsset::class);
    }

    public function affiliates()
    {
        return $this->hasManyThrough(Affiliate::class, AffiliateLink::class, 'affiliate_program_id', 'id', 'id', 'affiliate_id');
    }
}
