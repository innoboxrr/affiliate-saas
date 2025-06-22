<?php

namespace Innoboxrr\AffiliateSaas\Models\Traits\Storage;

use Innoboxrr\AffiliateSaas\Models\AffiliateConversionMeta;

trait AffiliateConversionStorage
{

    public function createModel($request)
    {

        $affiliateConversion = $this->create($request->only($this->creatable));

        $affiliateConversion->updateModelMetas($request);

        return $affiliateConversion;

    }

    public function updateModel($request)
    {
     
        $this->update($request->only($this->updatable));

        $this->updateModelMetas($request);

        return $this;

    }

    public function updateModelMetas($request)
    {

        $this->update_metas($request, AffiliateConversionMeta::class, 'affiliate_conversion_id')->updatePayload();

        return $this;

    }

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