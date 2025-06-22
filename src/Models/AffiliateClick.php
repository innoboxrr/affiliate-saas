<?php

namespace Innoboxrr\AffiliateSaas\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Innoboxrr\Traits\MetaOperations;
use Innoboxrr\Traits\ModelAppendsTrait;
use Innoboxrr\AffiliateSaas\Models\Traits\Relations\AffiliateClickRelations;
use Innoboxrr\AffiliateSaas\Models\Traits\Storage\AffiliateClickStorage;
use Innoboxrr\AffiliateSaas\Models\Traits\Assignments\AffiliateClickAssignment;
use Innoboxrr\AffiliateSaas\Models\Traits\Operations\AffiliateClickOperations;
use Innoboxrr\AffiliateSaas\Models\Traits\Mutators\AffiliateClickMutators;
use Innoboxrr\AffiliateSaas\Support\Traits\Logger;

class AffiliateClick extends Model
{
    use HasFactory,
        SoftDeletes,
        MetaOperations,
        ModelAppendsTrait,
        AffiliateClickRelations,
        AffiliateClickStorage,
        AffiliateClickAssignment,
        AffiliateClickOperations,
        AffiliateClickMutators,
        Logger;

    protected $fillable = [
        'uuid',
        'ip_address',
        'user_agent',
        'referrer',
        'url',
        'affiliate_link_id',
    ];

    protected $creatable = [
        'uuid',
        'ip_address',
        'user_agent',
        'referrer',
        'url',
        'affiliate_link_id',
    ];

    protected $updatable = [
        // No actualizable
    ];

    protected $casts = [];

    protected $protected_metas = [];

    protected $editable_metas = [];

    public static $export_cols = [
        'id',
        'uuid',
        'ip_address',
        'user_agent',
        'referrer',
        'url',
        'affiliate_link_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public static $loadable_relations = [
        'link',
    ];

    public static $loadable_counts = [];

    protected static function newFactory()
    {
        return \Innoboxrr\AffiliateSaas\Database\Factories\AffiliateClickFactory::new();
    }
}
