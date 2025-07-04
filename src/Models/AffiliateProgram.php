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
        'server_token',
        'payload',
        'workspace_id',
    ];

    protected $creatable = [
        'name',
        'description',
        'server_token',
        'workspace_id',
    ];

    protected $updatable = [
        'name',
        'description',
        'server_token',
    ];

    protected $casts = [
        'payload' => 'array',
    ];

    protected $appends = [
        'allow_affiliate_register',
        'affiliate_register_url',
    ];

    protected $protected_metas = [];

    protected $editable_metas = [
        // Thechnical settings
        'test_mode',
        'tracking_model',
        'cookie_path', // Ruta donde se debe instalar la cookie 
        'cookie_lifetime',
        
        'commission_type', // 'percentage' or 'fixed'
        'default_commission',

        'currency',
        'payout_threshold',

        // Security settings
        'payout_threshold_days', // Días para el umbral de pago
        'allow_frontend_conversions',
        'allowed_urls',

        // Registration settings
        'registration_title',
        'registration_description',
        'registration_image',
        'allow_self_registration',
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
