<?php

namespace Innoboxrr\AffiliateSaas\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Innoboxrr\Traits\MetaOperations;
use Innoboxrr\Traits\ModelAppendsTrait;
use Innoboxrr\AffiliateSaas\Models\Traits\Relations\AffiliatePayoutRelations;
use Innoboxrr\AffiliateSaas\Models\Traits\Storage\AffiliatePayoutStorage;
use Innoboxrr\AffiliateSaas\Models\Traits\Assignments\AffiliatePayoutAssignment;
use Innoboxrr\AffiliateSaas\Models\Traits\Operations\AffiliatePayoutOperations;
use Innoboxrr\AffiliateSaas\Models\Traits\Mutators\AffiliatePayoutMutators;

class AffiliatePayout extends Model
{

    use HasFactory,
        SoftDeletes,
        MetaOperations,
        ModelAppendsTrait,
        AffiliatePayoutRelations,
        AffiliatePayoutStorage,
        AffiliatePayoutAssignment,
        AffiliatePayoutOperations,
        AffiliatePayoutMutators;
        
    protected $fillable = [
        //FILLABLE//
    ];

    protected $creatable = [
        //CREATABLE//
    ];

    protected $updatable = [
        //UPDATABLE//
    ];

    protected $casts = [
        //CASTS//
    ];

    protected $protected_metas = [];

    protected $editable_metas = [
        //EDITABLEMETAS//
    ];

    public static $export_cols = [
        //EXPORTCOLS//
    ];

    public static $loadable_relations = [
        //LOADABLERELATIONS//
    ];

    public static $loadable_counts = [
        //LOADABLECOUNTS//
    ];

    /*
    protected static function newFactory()
    {
        return \Innoboxrr\AffiliateSaas\Database\Factories\AffiliatePayoutFactory::new();
    }
    */

}
