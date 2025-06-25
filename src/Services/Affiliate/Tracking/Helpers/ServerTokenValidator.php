<?php

namespace Innoboxrr\AffiliateSaas\Services\Affiliate\Tracking\Helpers;

use Innoboxrr\AffiliateSaas\Models\AffiliateClick;

class ServerTokenValidator
{
    protected AffiliateClick $click;

    public static function validate(string $token, AffiliateClick $click): bool
    {
        $programToken = $click->link->program->server_token;
        if (!$programToken) {
            return false; // No hay token de servidor configurado
        }
        
        return hash_equals($token, $programToken);
    }
}