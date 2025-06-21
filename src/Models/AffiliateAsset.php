<?php

namespace Innoboxrr\AffiliateSaas\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Innoboxrr\Traits\MetaOperations;
use Innoboxrr\Traits\ModelAppendsTrait;
use Innoboxrr\AffiliateSaas\Models\Traits\Relations\AffiliateAssetRelations;
use Innoboxrr\AffiliateSaas\Models\Traits\Storage\AffiliateAssetStorage;
use Innoboxrr\AffiliateSaas\Models\Traits\Assignments\AffiliateAssetAssignment;
use Innoboxrr\AffiliateSaas\Models\Traits\Operations\AffiliateAssetOperations;
use Innoboxrr\AffiliateSaas\Models\Traits\Mutators\AffiliateAssetMutators;

class AffiliateAsset extends Model
{

    use HasFactory,
        SoftDeletes,
        MetaOperations,
        ModelAppendsTrait,
        AffiliateAssetRelations,
        AffiliateAssetStorage,
        AffiliateAssetAssignment,
        AffiliateAssetOperations,
        AffiliateAssetMutators;
        
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
        return \Innoboxrr\AffiliateSaas\Database\Factories\AffiliateAssetFactory::new();
    }
    */

}
