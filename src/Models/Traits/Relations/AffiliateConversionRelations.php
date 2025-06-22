<?php

namespace Innoboxrr\AffiliateSaas\Models\Traits\Relations;

use Innoboxrr\AffiliateSaas\Models\AffiliateConversionMeta;
use Innoboxrr\AffiliateSaas\Models\AffiliateClick;
use Innoboxrr\AffiliateSaas\Models\AffiliateLink;
use Innoboxrr\AffiliateSaas\Models\Affiliate;
use Innoboxrr\AffiliateSaas\Models\AffiliateProgram;
use \Znck\Eloquent\Traits\BelongsToThrough; // Docs: https://github.com/staudenmeir/belongs-to-through
// use \Staudenmeir\EloquentHasManyDeep\HasRelationships; // Docs: https://github.com/staudenmeir/eloquent-has-many-deep

trait AffiliateConversionRelations
{
    use BelongsToThrough; 

    public function metas()
    {
        return $this->hasMany(AffiliateConversionMeta::class, 'affiliate_conversion_id');
    }

    public function click()
    {
        return $this->belongsTo(AffiliateClick::class, 'affiliate_click_id');
    }

    public function link()
    {
        return $this->belongsTo(AffiliateLink::class, 'affiliate_link_id');
    }

    public function affiliate()
    {
        return $this->belongsToThrough(Affiliate::class, AffiliateLink::class);
    }

    public function program()
    {
        return $this->belongsToThrough(AffiliateProgram::class, AffiliateLink::class);
    }
}
