<?php

namespace Innoboxrr\AffiliateSaas\Models\Filters\Affiliate;

use Innoboxrr\SearchSurge\Search\Utils\Managed;

class ManagedFilter extends Managed
{

    public static function canView($query, $user, array $args = [])
    {   

        // Añadir restricciones de visibilidad
        if(method_exists($user, 'managedAffiliateFilter')) {
            $query = $user->managedAffiliateFilter($query, $user, $args);
        }
        return $query;

    }

}