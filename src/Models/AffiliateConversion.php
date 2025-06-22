<?php

namespace Innoboxrr\AffiliateSaas\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Innoboxrr\Traits\MetaOperations;
use Innoboxrr\Traits\ModelAppendsTrait;
use Innoboxrr\AffiliateSaas\Models\Traits\Relations\AffiliateConversionRelations;
use Innoboxrr\AffiliateSaas\Models\Traits\Storage\AffiliateConversionStorage;
use Innoboxrr\AffiliateSaas\Models\Traits\Assignments\AffiliateConversionAssignment;
use Innoboxrr\AffiliateSaas\Models\Traits\Operations\AffiliateConversionOperations;
use Innoboxrr\AffiliateSaas\Models\Traits\Mutators\AffiliateConversionMutators;
use Innoboxrr\AffiliateSaas\Enums\AffiliateConversion\EventType as AffiliateConversionEventType;
use Innoboxrr\AffiliateSaas\Enums\AffiliateConversion\Status as AffiliateConversionStatus;
use Innoboxrr\AffiliateSaas\Support\Traits\Logger;

class AffiliateConversion extends Model
{
    use HasFactory,
        SoftDeletes,
        MetaOperations,
        ModelAppendsTrait,
        AffiliateConversionRelations,
        AffiliateConversionStorage,
        AffiliateConversionAssignment,
        AffiliateConversionOperations,
        AffiliateConversionMutators,
        Logger;

    protected $fillable = [
        'status',
        'amount',
        'currency',
        'commission',
        'event_type',
        'payload',
        'is_test',
        'approved_by',
        'approved_at',
        'external_order_id',
        'external_user_id',
        'affiliate_link_id',
        'affiliate_click_id',
        'affiliate_payout_id',
    ];

    protected $creatable = [
        'status',
        'amount',
        'currency',
        'commission',
        'event_type',
        'is_test',
        'external_order_id',
        'external_user_id',
        'affiliate_link_id',
        'affiliate_click_id',
    ];

    protected $updatable = [
        'status',
        'commission',
        'approved_by',
        'approved_at',
        'affiliate_payout_id',
    ];

    protected $casts = [
        'payload' => 'array',
        'is_test' => 'boolean',
        'approved_at' => 'datetime',
        'amount' => 'decimal:2',
        'commission' => 'decimal:2',
        'status' => AffiliateConversionStatus::class,
        'event_type' => AffiliateConversionEventType::class,
    ];

    protected $protected_metas = [];

    protected $editable_metas = [
        'note',
        'source',
    ];

    public static $export_cols = [
        'id',
        'status',
        'amount',
        'currency',
        'commission',
        'event_type',
        'is_test',
        'external_order_id',
        'external_user_id',
        'affiliate_link_id',
        'affiliate_click_id',
        'affiliate_payout_id',
        'approved_by',
        'approved_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public static $loadable_relations = [
        'link',
        'click',
        'payout',
        'metas',
    ];

    public static $loadable_counts = [];

    protected static function newFactory()
    {
        return \Innoboxrr\AffiliateSaas\Database\Factories\AffiliateConversionFactory::new();
    }
}
