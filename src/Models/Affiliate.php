<?php

namespace Innoboxrr\AffiliateSaas\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Innoboxrr\Traits\MetaOperations;
use Innoboxrr\Traits\ModelAppendsTrait;
use Innoboxrr\AffiliateSaas\Models\Traits\Relations\AffiliateRelations;
use Innoboxrr\AffiliateSaas\Models\Traits\Storage\AffiliateStorage;
use Innoboxrr\AffiliateSaas\Models\Traits\Assignments\AffiliateAssignment;
use Innoboxrr\AffiliateSaas\Models\Traits\Operations\AffiliateOperations;
use Innoboxrr\AffiliateSaas\Models\Traits\Mutators\AffiliateMutators;

class Affiliate extends Model
{

    use HasFactory,
        SoftDeletes,
        MetaOperations,
        ModelAppendsTrait,
        AffiliateRelations,
        AffiliateStorage,
        AffiliateAssignment,
        AffiliateOperations,
        AffiliateMutators;
        
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
        return \Innoboxrr\AffiliateSaas\Database\Factories\AffiliateFactory::new();
    }
    */

}
