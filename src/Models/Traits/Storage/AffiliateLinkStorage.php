<?php

namespace Innoboxrr\AffiliateSaas\Models\Traits\Storage;

// use Innoboxrr\AffiliateSaas\Models\AffiliateLinkMeta;

trait AffiliateLinkStorage
{

    public function createModel($request)
    {

        $affiliateLink = $this->create($request->only($this->creatable));

        return $affiliateLink;

    }

    public function updateModel($request)
    {
     
        $this->update($request->only($this->updatable));

        return $this;

    }

    /*
    public function updateModelMetas($request)
    {

        $this->update_metas($request, AffiliateLinkMeta::class, 'affiliate_link_id')->updatePayload();

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