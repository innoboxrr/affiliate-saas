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
use Innoboxrr\AffiliateSaas\Support\Traits\Logger;

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
        AffiliateProgramMutators,
        Logger;

    protected $fillable = [
        'name',
        'description',
        'payload',
        'workspace_id',
    ];

    protected $creatable = [
        'name',
        'description',
        'workspace_id',
    ];

    protected $updatable = [
        'name',
        'description',
    ];

    protected $casts = [
        'payload' => 'array',
    ];

    protected $protected_metas = [];

    protected $editable_metas = [
        'test_mode',
        'tracking_model',
        'cookie_path', // Ruta donde se debe instalar la cookie 
        'cookie_lifetime',
        'default_commission',
    ];

    public static $export_cols = [
        'id',
        'name',
        'description',
        'workspace_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public static $loadable_relations = [
        'workspace',
        'affiliates',
        'links',
        'assets',
        'metas',
    ];

    public static $loadable_counts = [
        'affiliates',
        'links',
        'assets',
    ];

    protected static function newFactory()
    {
        return \Innoboxrr\AffiliateSaas\Database\Factories\AffiliateProgramFactory::new();
    }
}
