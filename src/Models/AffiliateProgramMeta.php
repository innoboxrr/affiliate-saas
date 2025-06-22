<?php

namespace Innoboxrr\AffiliateSaas\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AffiliateProgramMeta extends Model
{

    use HasFactory;

    protected $guarded = [];

    public function affiliateProgram()
    {
        return $this->belongsTo(AffiliateProgram::class);
    }

}
