<?php

namespace Innoboxrr\AffiliateSaas\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AffiliateAssetMeta extends Model
{

    use HasFactory;

    protected $guarded = [];

    public function affiliateAsset()
    {
        return $this->belongsTo(AffiliateAsset::class);
    }

}
