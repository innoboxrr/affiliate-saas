<?php

namespace Innoboxrr\AffiliateSaas\Models\Traits\Relations;

use Innoboxrr\AffiliateSaas\Models\Affiliate;
use Innoboxrr\AffiliateSaas\Models\AffiliateProgram;
use Innoboxrr\AffiliateSaas\Models\AffiliateClick;
use Innoboxrr\AffiliateSaas\Models\AffiliateConversion;
use \Znck\Eloquent\Traits\BelongsToThrough; // Docs: https://github.com/staudenmeir/belongs-to-through
// use \Staudenmeir\EloquentHasManyDeep\HasRelationships; // Docs: https://github.com/staudenmeir/eloquent-has-many-deep

trait AffiliateLinkRelations
{
    use BelongsToThrough; 

    public function affiliate()
    {
        return $this->belongsTo(Affiliate::class);
    }

    public function program()
    {
        return $this->belongsToThrough(AffiliateProgram::class, Affiliate::class);
    }

    public function clicks()
    {
        return $this->hasMany(AffiliateClick::class);
    }

    public function conversions()
    {
        return $this->hasMany(AffiliateConversion::class);
    }
}
