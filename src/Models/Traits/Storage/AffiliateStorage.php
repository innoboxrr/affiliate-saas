<?php

namespace Innoboxrr\AffiliateSaas\Models\Traits\Storage;

// use Innoboxrr\AffiliateSaas\Models\AffiliateMeta;

trait AffiliateStorage
{

    public function createModel($request)
    {

        $affiliate = $this->create($request->only($this->creatable));

        return $affiliate;

    }

    public function updateModel($request)
    {
     
        $this->update($request->only($this->updatable));

        return $this;

    }

    /*
    public function updateModelMetas($request)
    {

        $this->update_metas($request, AffiliateMeta::class, 'affiliate_id')->updatePayload();

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