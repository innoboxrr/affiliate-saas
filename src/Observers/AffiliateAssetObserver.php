<?php
 
namespace Innoboxrr\AffiliateSaas\Observers;
 
use Innoboxrr\AffiliateSaas\Models\AffiliateAsset;
 
class AffiliateAssetObserver
{

    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    // public $afterCommit = true;

    /**
     * Handle the AffiliateAsset "created" event.
     */
    public function created(AffiliateAsset $affiliateAsset): void
    {
        // Remove if laravel-audit is used: $affiliateAsset->log('created');
    }
 
    /**
     * Handle the AffiliateAsset "updated" event.
     */
    public function updated(AffiliateAsset $affiliateAsset): void
    {
        // Remove if laravel-audit is used: $affiliateAsset->log('updated');
    }
 
    /**
     * Handle the AffiliateAsset "deleted" event.
     */
    public function deleted(AffiliateAsset $affiliateAsset): void
    {
        // Remove if laravel-audit is used: $affiliateAsset->log('deleted');
    }
 
    /**
     * Handle the AffiliateAsset "restored" event.
     */
    public function restored(AffiliateAsset $affiliateAsset): void
    {
        // Remove if laravel-audit is used: $affiliateAsset->log('restored');
    }
 
    /**
     * Handle the AffiliateAsset "forceDeleted" event.
     */
    public function forceDeleted(AffiliateAsset $affiliateAsset): void
    {
        // Remove if laravel-audit is used: $affiliateAsset->log('forceDeleted');
    }
}