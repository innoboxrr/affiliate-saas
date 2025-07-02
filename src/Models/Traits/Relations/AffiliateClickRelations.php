<?php

namespace Innoboxrr\AffiliateSaas\Models\Traits\Relations;

use Innoboxrr\AffiliateSaas\Models\Affiliate;
use Innoboxrr\AffiliateSaas\Models\AffiliateLink;
use Innoboxrr\AffiliateSaas\Models\AffiliateConversion;
use Innoboxrr\AffiliateSaas\Models\AffiliateProgram;
use \Znck\Eloquent\Traits\BelongsToThrough; // Docs: https://github.com/staudenmeir/belongs-to-through
// use \Staudenmeir\EloquentHasManyDeep\HasRelationships; // Docs: https://github.com/staudenmeir/eloquent-has-many-deep

trait AffiliateClickRelations
{
    use BelongsToThrough;

    public function program()
    {
        return $this->belongsToThrough(AffiliateProgram::class, [
            Affiliate::class,
            AffiliateLink::class
        ]);
    }

    public function link()
    {
        return $this->belongsTo(AffiliateLink::class, 'affiliate_link_id');
    }

    public function conversions()
    {
        return $this->hasMany(AffiliateConversion::class, 'affiliate_click_id');
    }
}