<?php

namespace Innoboxrr\AffiliateSaas\Models\Filters\AffiliateConversion;

use Innoboxrr\SearchSurge\Search\Utils\Managed;

class ManagedFilter extends Managed
{

    public static function canView($query, $user, array $args = [])
    {   

        // Añadir restricciones de visibilidad
        if(method_exists($user, 'managedAffiliateConversionFilter')) {
            $query = $user->managedAffiliateConversionFilter($query, $args);
        }
        return $query;

    }

}