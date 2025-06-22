<?php
 
namespace Innoboxrr\AffiliateSaas\Observers;
 
use Innoboxrr\AffiliateSaas\Models\AffiliatePayout;
 
class AffiliatePayoutObserver
{

    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    // public $afterCommit = true;

    /**
     * Handle the AffiliatePayout "created" event.
     */
    public function created(AffiliatePayout $affiliatePayout): void
    {
        $affiliatePayout->log('created');
    }
 
    /**
     * Handle the AffiliatePayout "updated" event.
     */
    public function updated(AffiliatePayout $affiliatePayout): void
    {
        $affiliatePayout->log('updated');
    }
 
    /**
     * Handle the AffiliatePayout "deleted" event.
     */
    public function deleted(AffiliatePayout $affiliatePayout): void
    {
        $affiliatePayout->log('deleted');
    }
 
    /**
     * Handle the AffiliatePayout "restored" event.
     */
    public function restored(AffiliatePayout $affiliatePayout): void
    {
        $affiliatePayout->log('restored');
    }
 
    /**
     * Handle the AffiliatePayout "forceDeleted" event.
     */
    public function forceDeleted(AffiliatePayout $affiliatePayout): void
    {
        $affiliatePayout->log('forceDeleted');
    }
}