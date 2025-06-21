<?php

namespace Innoboxrr\AffiliateSaas\Models\Traits\Storage;

// use Innoboxrr\AffiliateSaas\Models\AffiliateClickMeta;

trait AffiliateClickStorage
{

    public function createModel($request)
    {

        $affiliateClick = $this->create($request->only($this->creatable));

        return $affiliateClick;

    }

    public function updateModel($request)
    {
     
        $this->update($request->only($this->updatable));

        return $this;

    }

    /*
    public function updateModelMetas($request)
    {

        $this->update_metas($request, AffiliateClickMeta::class, 'affiliate_click_id')->updatePayload();

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