<?php

namespace Innoboxrr\AffiliateSaas\Models\Traits\Relations;

use Innoboxrr\AffiliateSaas\Models\AffiliateLink;
use Innoboxrr\AffiliateSaas\Models\AffiliateConversion;
// use \Znck\Eloquent\Traits\BelongsToThrough; // Docs: https://github.com/staudenmeir/belongs-to-through
// use \Staudenmeir\EloquentHasManyDeep\HasRelationships; // Docs: https://github.com/staudenmeir/eloquent-has-many-deep

trait AffiliateClickRelations
{
    public function link()
    {
        return $this->belongsTo(AffiliateLink::class, 'affiliate_link_id');
    }

    public function conversions()
    {
        return $this->hasMany(AffiliateConversion::class, 'affiliate_click_id');
    }
}