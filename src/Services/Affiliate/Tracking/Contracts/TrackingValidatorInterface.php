<?php

namespace Innoboxrr\AffiliateSaas\Services\Affiliate\Tracking\Contracts;

interface TrackingValidatorInterface
{
    /**
     * Realiza la validación del request entrante.
     *
     * @return mixed Un objeto de error o null si pasa la validación.
     */
    public function fails(): mixed;

    /**
     * Devuelve el modelo asociado (AffiliateLink o AffiliateClick) tras la validación.
     *
     * @return mixed
     */
    public function getValidatedEntity(): mixed;
}
