<?php

namespace Innoboxrr\AffiliateSaas\Models\Filters\AffiliateClick;

use Innoboxrr\SearchSurge\Search\Utils\Managed;

class ManagedFilter extends Managed
{

    public static function canView($query, $user, array $args = [])
    {   

        // Añadir restricciones de visibilidad
        if(method_exists($user, 'managedAffiliateClickFilter')) {
            $query = $user->managedAffiliateClickFilter($query, $user, $args);
        }
        return $query;

    }

}