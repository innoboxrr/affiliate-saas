<?php
 
namespace Innoboxrr\AffiliateSaas\Observers;
 
use Innoboxrr\AffiliateSaas\Models\AffiliateProgram;
 
class AffiliateProgramObserver
{

    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    // public $afterCommit = true;

    /**
     * Handle the AffiliateProgram "created" event.
     */
    public function created(AffiliateProgram $affiliateProgram): void
    {
        $affiliateProgram->log('created');
    }
 
    /**
     * Handle the AffiliateProgram "updated" event.
     */
    public function updated(AffiliateProgram $affiliateProgram): void
    {
        $affiliateProgram->log('updated');
    }
 
    /**
     * Handle the AffiliateProgram "deleted" event.
     */
    public function deleted(AffiliateProgram $affiliateProgram): void
    {
        $affiliateProgram->log('deleted');
    }
 
    /**
     * Handle the AffiliateProgram "restored" event.
     */
    public function restored(AffiliateProgram $affiliateProgram): void
    {
        $affiliateProgram->log('restored');
    }
 
    /**
     * Handle the AffiliateProgram "forceDeleted" event.
     */
    public function forceDeleted(AffiliateProgram $affiliateProgram): void
    {
        $affiliateProgram->log('forceDeleted');
    }
}