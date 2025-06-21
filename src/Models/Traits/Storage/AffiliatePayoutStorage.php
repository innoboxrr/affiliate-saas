<?php

namespace Innoboxrr\AffiliateSaas\Models\Traits\Storage;

// use Innoboxrr\AffiliateSaas\Models\AffiliatePayoutMeta;

trait AffiliatePayoutStorage
{

    public function createModel($request)
    {

        $affiliatePayout = $this->create($request->only($this->creatable));

        return $affiliatePayout;

    }

    public function updateModel($request)
    {
     
        $this->update($request->only($this->updatable));

        return $this;

    }

    /*
    public function updateModelMetas($request)
    {

        $this->update_metas($request, AffiliatePayoutMeta::class, 'affiliate_payout_id')->updatePayload();

        return $this;

    }
    */

    public function deleteModel()
    {

        $this->delete();

    }

    public function restoreModel()
    {

        $this->restore();

    }

    public function forceDeleteModel()
    {

        abort(403);

        $this->forceDelete();
        
    }

}