<?php
 
namespace Innoboxrr\AffiliateSaas\Observers;
 
use Innoboxrr\AffiliateSaas\Models\AffiliateClick;
 
class AffiliateClickObserver
{

    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    // public $afterCommit = true;

    /**
     * Handle the AffiliateClick "created" event.
     */
    public function created(AffiliateClick $affiliateClick): void
    {
        $affiliateClick->log('created');
    }
 
    /**
     * Handle the AffiliateClick "updated" event.
     */
    public function updated(AffiliateClick $affiliateClick): void
    {
        $affiliateClick->log('updated');
    }
 
    /**
     * Handle the AffiliateClick "deleted" event.
     */
    public function deleted(AffiliateClick $affiliateClick): void
    {
        $affiliateClick->log('deleted');
    }
 
    /**
     * Handle the AffiliateClick "restored" event.
     */
    public function restored(AffiliateClick $affiliateClick): void
    {
        $affiliateClick->log('restored');
    }
 
    /**
     * Handle the AffiliateClick "forceDeleted" event.
     */
    public function forceDeleted(AffiliateClick $affiliateClick): void
    {
        $affiliateClick->log('forceDeleted');
    }
}