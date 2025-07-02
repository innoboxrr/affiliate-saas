<?php

namespace Innoboxrr\AffiliateSaas\Models\Traits\Relations;

use Innoboxrr\AffiliateSaas\Models\AffiliateProgram;
use Innoboxrr\AffiliateSaas\Models\AffiliateLink;
use Innoboxrr\AffiliateSaas\Models\AffiliatePayoutMeta;
use Innoboxrr\AffiliateSaas\Models\Affiliate;
use Innoboxrr\AffiliateSaas\Models\AffiliateConversion;
use \Znck\Eloquent\Traits\BelongsToThrough; // Docs: https://github.com/staudenmeir/belongs-to-through
// use \Staudenmeir\EloquentHasManyDeep\HasRelationships; // Docs: https://github.com/staudenmeir/eloquent-has-many-deep

trait AffiliatePayoutRelations
{
    use BelongsToThrough;
    
    public function metas()
    {
        return $this->hasMany(AffiliatePayoutMeta::class, 'affiliate_payout_id');
    }

    public function affiliate()
    {
        return $this->belongsTo(Affiliate::class);
    }

    public function conversions()
    {
        return $this->hasMany(AffiliateConversion::class);
    }

    public function program()
    {
        return $this->belongsToThrough(AffiliateProgram::class, [
            Affiliate::class
        ]);
    }

}
