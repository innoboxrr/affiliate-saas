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
use Innoboxrr\AffiliateSaas\Enums\AffiliateAsset\Type as AffiliateAssetType;
use Innoboxrr\AffiliateSaas\Support\Traits\Logger;

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
        AffiliateAssetMutators,
        Logger;

    protected $fillable = [
        'name',
        'type',
        'url',
        'payload',
        'affiliate_program_id',
    ];

    protected $creatable = [
        'name',
        'type',
        'url',
        'affiliate_program_id',
    ];

    protected $updatable = [
        'name',
        'type',
        'url',
    ];

    protected $casts = [
        'payload' => 'array',
        'type' => AffiliateAssetType::class,
    ];

    protected $protected_metas = [];

    protected $editable_metas = [
        'usage_notes',
    ];

    public static $export_cols = [
        'id',
        'name',
        'type',
        'url',
        'affiliate_program_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public static $loadable_relations = [
        'program',
        'metas',
    ];

    public static $loadable_counts = [];

    protected static function newFactory()
    {
        return \Innoboxrr\AffiliateSaas\Database\Factories\AffiliateAssetFactory::new();
    }
}
