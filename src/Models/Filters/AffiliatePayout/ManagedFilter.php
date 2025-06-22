<?php

namespace Innoboxrr\AffiliateSaas\Models\Filters\AffiliatePayout;

use Innoboxrr\SearchSurge\Search\Utils\Managed;

class ManagedFilter extends Managed
{

    public static function canView($query, $user, array $args = [])
    {   

        // Añadir restricciones de visibilidad
        if(method_exists($user, 'managedAffiliatePayoutFilter')) {
            $query = $user->managedAffiliatePayoutFilter($query, $user, $args);
        }
        return $query;

    }

}