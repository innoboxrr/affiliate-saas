<?php

namespace Innoboxrr\AffiliateSaas\Models\Traits\Storage;

// use Innoboxrr\AffiliateSaas\Models\AffiliateAssetMeta;

trait AffiliateAssetStorage
{

    public function createModel($request)
    {

        $affiliateAsset = $this->create($request->only($this->creatable));

        return $affiliateAsset;

    }

    public function updateModel($request)
    {
     
        $this->update($request->only($this->updatable));

        return $this;

    }

    /*
    public function updateModelMetas($request)
    {

        $this->update_metas($request, AffiliateAssetMeta::class, 'affiliate_asset_id')->updatePayload();

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