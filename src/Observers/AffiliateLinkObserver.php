<?php
 
namespace Innoboxrr\AffiliateSaas\Observers;
 
use Innoboxrr\AffiliateSaas\Models\AffiliateLink;
 
class AffiliateLinkObserver
{

    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    // public $afterCommit = true;

    /**
     * Handle the AffiliateLink "created" event.
     */
    public function created(AffiliateLink $affiliateLink): void
    {
        $affiliateLink->log('created');
    }
 
    /**
     * Handle the AffiliateLink "updated" event.
     */
    public function updated(AffiliateLink $affiliateLink): void
    {
        $affiliateLink->log('updated');
    }
 
    /**
     * Handle the AffiliateLink "deleted" event.
     */
    public function deleted(AffiliateLink $affiliateLink): void
    {
        $affiliateLink->log('deleted');
    }
 
    /**
     * Handle the AffiliateLink "restored" event.
     */
    public function restored(AffiliateLink $affiliateLink): void
    {
        $affiliateLink->log('restored');
    }
 
    /**
     * Handle the AffiliateLink "forceDeleted" event.
     */
    public function forceDeleted(AffiliateLink $affiliateLink): void
    {
        $affiliateLink->log('forceDeleted');
    }
}