<?php

namespace Innoboxrr\AffiliateSaas\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AffiliateMeta extends Model
{

    use HasFactory;

    protected $guarded = [];

    public function affiliate()
    {
        return $this->belongsTo(Affiliate::class);
    }

}
