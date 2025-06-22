<?php

namespace Innoboxrr\AffiliateSaas\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AffiliatePayoutMeta extends Model
{

    use HasFactory;

    protected $guarded = [];

    public function affiliatePayout()
    {
        return $this->belongsTo(AffiliatePayout::class);
    }

}
