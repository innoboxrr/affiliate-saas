<?php
 
namespace Innoboxrr\AffiliateSaas\Observers;
 
use Innoboxrr\AffiliateSaas\Models\Affiliate;
 
class AffiliateObserver
{

    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    // public $afterCommit = true;

    /**
     * Handle the Affiliate "created" event.
     */
    public function created(Affiliate $affiliate): void
    {
        $affiliate->log('created');
    }
 
    /**
     * Handle the Affiliate "updated" event.
     */
    public function updated(Affiliate $affiliate): void
    {
        $affiliate->log('updated');
    }
 
    /**
     * Handle the Affiliate "deleted" event.
     */
    public function deleted(Affiliate $affiliate): void
    {
        $affiliate->log('deleted');
    }
 
    /**
     * Handle the Affiliate "restored" event.
     */
    public function restored(Affiliate $affiliate): void
    {
        $affiliate->log('restored');
    }
 
    /**
     * Handle the Affiliate "forceDeleted" event.
     */
    public function forceDeleted(Affiliate $affiliate): void
    {
        $affiliate->log('forceDeleted');
    }
}