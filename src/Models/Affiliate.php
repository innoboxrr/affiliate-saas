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
use Innoboxrr\AffiliateSaas\Support\Traits\Logger;

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
        AffiliateMutators,
        Logger;
        
    protected $fillable = [
        'payload',
        'workspace_id',
        'user_id',
        'verified_at',
    ];

    protected $creatable = [
        'workspace_id',
        'user_id',
        'verified_at',
    ];

    protected $updatable = [
        'verified_at',
    ];

    protected $casts = [
        'payload' => 'array',
        'verified_at' => 'datetime',
    ];

    protected $protected_metas = [];

    protected $editable_metas = [
        'payment_method',
        'payment_data',
        'affiliate_type',
    ];

    public static $export_cols = [
        'id',
        'workspace_id',
        'user_id',
        'verified_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public static $loadable_relations = [
        'user',
        'workspace',
        'links',
        'metas',
        'conversions',
    ];

    public static $loadable_counts = [
        'links',
        'conversions',
    ];

    protected static function newFactory()
    {
        return \Innoboxrr\AffiliateSaas\Database\Factories\AffiliateFactory::new();
    }
}
