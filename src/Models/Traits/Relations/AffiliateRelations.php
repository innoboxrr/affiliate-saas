<?php

namespace Innoboxrr\AffiliateSaas\Models\Traits\Relations;

use Innoboxrr\AffiliateSaas\Models\AffiliateLink;
use Innoboxrr\AffiliateSaas\Models\AffiliateConversion;
use Innoboxrr\AffiliateSaas\Models\AffiliateMeta;
use \Znck\Eloquent\Traits\BelongsToThrough; // Docs: https://github.com/staudenmeir/belongs-to-through
// use \Staudenmeir\EloquentHasManyDeep\HasRelationships; // Docs: https://github.com/staudenmeir/eloquent-has-many-deep

trait AffiliateRelations
{
    use BelongsToThrough;


    public function user()
    {
        return $this->belongsTo(config('affiliate.user_class'));
    }

    public function workspace()
    {
        return $this->belongsTo(config('affiliate.workspace_class'), 'workspace_id');
    }

    public function links()
    {
        return $this->hasMany(AffiliateLink::class);
    }

    public function metas()
    {
        return $this->hasMany(AffiliateMeta::class);
    }

    public function conversions()
    {
        return $this->hasManyThrough(AffiliateConversion::class, AffiliateLink::class, 'affiliate_id', 'affiliate_link_id');
    }
}
