<?php

namespace Innoboxrr\AffiliateSaas\Models\Traits\Operations;

trait AffiliateProgramOperations
{

    public function buildPayload()
    {

        return [];

    }

    public function updatePayload()
    {

        $this->payload = $this->buildPayload();

        return $this->save();

    }

}
