<?php

namespace Innoboxrr\AffiliateSaas\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Innoboxrr\Traits\MetaOperations;
use Innoboxrr\Traits\ModelAppendsTrait;
use Innoboxrr\AffiliateSaas\Models\Traits\Relations\AffiliatePayoutRelations;
use Innoboxrr\AffiliateSaas\Models\Traits\Storage\AffiliatePayoutStorage;
use Innoboxrr\AffiliateSaas\Models\Traits\Assignments\AffiliatePayoutAssignment;
use Innoboxrr\AffiliateSaas\Models\Traits\Operations\AffiliatePayoutOperations;
use Innoboxrr\AffiliateSaas\Models\Traits\Mutators\AffiliatePayoutMutators;
use Innoboxrr\AffiliateSaas\Enums\AffiliatePayout\Status as AffiliatePayoutStatus;
use Innoboxrr\AffiliateSaas\Enums\AffiliatePayout\Processor as AffiliatePayoutProcessor;
use Innoboxrr\AffiliateSaas\Support\Traits\Logger;

class AffiliatePayout extends Model
{
    use HasFactory,
        SoftDeletes,
        MetaOperations,
        ModelAppendsTrait,
        AffiliatePayoutRelations,
        AffiliatePayoutStorage,
        AffiliatePayoutAssignment,
        AffiliatePayoutOperations,
        AffiliatePayoutMutators,
        Logger;

    protected $fillable = [
        'processor',
        'status',
        'amount',
        'currency',
        'payload',
        'paid_at',
        'affiliate_id',
    ];

    protected $creatable = [
        'processor',
        'status',
        'amount',
        'currency',
        'affiliate_id',
    ];

    protected $updatable = [
        'status',
        'paid_at',
        'payload',
    ];

    protected $casts = [
        'payload' => 'array',
        'paid_at' => 'datetime',
        'amount' => 'decimal:2',
        'status' => AffiliatePayoutStatus::class,
        'processor' => AffiliatePayoutProcessor::class,
    ];

    protected $protected_metas = [];

    protected $editable_metas = [
        'notes',
        'payment_reference',
    ];

    public static $export_cols = [
        'id',
        'affiliate_id',
        'processor',
        'status',
        'amount',
        'currency',
        'paid_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public static $loadable_relations = [
        'affiliate',
        'conversions',
        'metas',
    ];

    public static $loadable_counts = [
        'conversions',
    ];

    protected static function newFactory()
    {
        return \Innoboxrr\AffiliateSaas\Database\Factories\AffiliatePayoutFactory::new();
    }
}
