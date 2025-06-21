<?php

namespace Innoboxrr\AffiliateSaas\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Innoboxrr\Traits\MetaOperations;
use Innoboxrr\Traits\ModelAppendsTrait;
use Innoboxrr\AffiliateSaas\Models\Traits\Relations\AffiliateProgramRelations;
use Innoboxrr\AffiliateSaas\Models\Traits\Storage\AffiliateProgramStorage;
use Innoboxrr\AffiliateSaas\Models\Traits\Assignments\AffiliateProgramAssignment;
use Innoboxrr\AffiliateSaas\Models\Traits\Operations\AffiliateProgramOperations;
use Innoboxrr\AffiliateSaas\Models\Traits\Mutators\AffiliateProgramMutators;

class AffiliateProgram extends Model
{

    use HasFactory,
        SoftDeletes,
        MetaOperations,
        ModelAppendsTrait,
        AffiliateProgramRelations,
        AffiliateProgramStorage,
        AffiliateProgramAssignment,
        AffiliateProgramOperations,
        AffiliateProgramMutators;
        
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
        return \Innoboxrr\AffiliateSaas\Database\Factories\AffiliateProgramFactory::new();
    }
    */

}
