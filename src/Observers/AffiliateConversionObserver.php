<?php
 
namespace Innoboxrr\AffiliateSaas\Observers;
 
use Innoboxrr\AffiliateSaas\Models\AffiliateConversion;
 
class AffiliateConversionObserver
{

    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    // public $afterCommit = true;

    /**
     * Handle the AffiliateConversion "created" event.
     */
    public function created(AffiliateConversion $affiliateConversion): void
    {
        $affiliateConversion->log('created');
    }
 
    /**
     * Handle the AffiliateConversion "updated" event.
     */
    public function updated(AffiliateConversion $affiliateConversion): void
    {
        $affiliateConversion->log('updated');
    }
 
    /**
     * Handle the AffiliateConversion "deleted" event.
     */
    public function deleted(AffiliateConversion $affiliateConversion): void
    {
        $affiliateConversion->log('deleted');
    }
 
    /**
     * Handle the AffiliateConversion "restored" event.
     */
    public function restored(AffiliateConversion $affiliateConversion): void
    {
        $affiliateConversion->log('restored');
    }
 
    /**
     * Handle the AffiliateConversion "forceDeleted" event.
     */
    public function forceDeleted(AffiliateConversion $affiliateConversion): void
    {
        $affiliateConversion->log('forceDeleted');
    }
}