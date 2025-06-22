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
use Innoboxrr\AffiliateSaas\Support\Traits\Logger;

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
        AffiliateLinkMutators,
        Logger;

    protected $fillable = [
        'name',
        'code',
        'target',
        'affiliate_id',
        'affiliate_program_id',
    ];

    protected $creatable = [
        'name',
        'code',
        'target',
        'affiliate_id',
        'affiliate_program_id',
    ];

    protected $updatable = [
        'name',
        'target',
    ];

    protected $casts = [];

    protected $protected_metas = [];

    protected $editable_metas = [
        'label',
        'channel',
        'utm_source',
    ];

    public static $export_cols = [
        'id',
        'name',
        'code',
        'target',
        'affiliate_id',
        'affiliate_program_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public static $loadable_relations = [
        'affiliate',
        'program',
        'clicks',
        'conversions',
        'metas',
    ];

    public static $loadable_counts = [
        'clicks',
        'conversions',
    ];

    protected static function newFactory()
    {
        return \Innoboxrr\AffiliateSaas\Database\Factories\AffiliateLinkFactory::new();
    }
}
