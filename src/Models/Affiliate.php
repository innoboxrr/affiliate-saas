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
        'affiliate_program_id',
        'user_id',
        'verified_at',
    ];

    protected $creatable = [
        'affiliate_program_id',
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
        'user_name',
        'user_email',
        'user_phone',
        'address_street',
        'address_city',
        'address_state',
        'address_country',
        'address_zip',
        'links_website',
        'links_facebook',
        'links_twitter',
        'links_instagram',
        'links_linkedin',
        'links_youtube',
        'links_tiktok',
        'financial_affiliate_type',
        'financial_tax_id',
        'financial_comercial_name',
        'financial_payment_method',
        'financial_paypal_email',
        'financial_bank_name',
        'financial_account_number',
        'financial_account_holder',
        'financial_stripe_account_id',
    ];

    public static $export_cols = [
        'id',
        'affiliate_program_id',
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
