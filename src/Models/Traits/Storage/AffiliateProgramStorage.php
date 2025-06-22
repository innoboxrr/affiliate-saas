<?php

namespace Innoboxrr\AffiliateSaas\Models\Traits\Storage;

use Innoboxrr\AffiliateSaas\Models\AffiliateProgramMeta;

trait AffiliateProgramStorage
{

    public function createModel($request)
    {

        $affiliateProgram = $this->create($request->only($this->creatable));

        $affiliateProgram->updateModelMetas($request);

        return $affiliateProgram;

    }

    public function updateModel($request)
    {
     
        $this->update($request->only($this->updatable));

        $this->updateModelMetas($request);

        return $this;

    }

    public function updateModelMetas($request)
    {

        $this->update_metas($request, AffiliateProgramMeta::class, 'affiliate_program_id')->updatePayload();

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