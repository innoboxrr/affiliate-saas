<?php

namespace Innoboxrr\AffiliateSaas\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AffiliateConversionMeta extends Model
{

    use HasFactory;

    protected $guarded = [];

    public function affiliateConversion()
    {
        return $this->belongsTo(AffiliateConversion::class);
    }

}
