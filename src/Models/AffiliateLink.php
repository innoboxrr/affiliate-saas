<?php

namespace Innoboxrr\AffiliateSaas\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Innoboxrr\Traits\MetaOperations;
use Innoboxrr\Traits\ModelAppendsTrait;
use Innoboxrr\AffiliateSaas\Models\Traits\Relations\AffiliateLinkRelations;
use Innoboxrr\AffiliateSaas\Models\Traits\Storage\AffiliateLinkStorage;
use Innoboxrr\AffiliateSaas\Models\Traits\Assignments\AffiliateLinkAssignment;
use Innoboxrr\AffiliateSaas\Models\Traits\Operations\AffiliateLinkOperations;
use Innoboxrr\AffiliateSaas\Models\Traits\Mutators\AffiliateLinkMutators;

class AffiliateLink extends Model
{

    use HasFactory,
        SoftDeletes,
        MetaOperations,
        ModelAppendsTrait,
        AffiliateLinkRelations,
        AffiliateLinkStorage,
        AffiliateLinkAssignment,
        AffiliateLinkOperations,
        AffiliateLinkMutators;
        
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
        return \Innoboxrr\AffiliateSaas\Database\Factories\AffiliateLinkFactory::new();
    }
    */

}
