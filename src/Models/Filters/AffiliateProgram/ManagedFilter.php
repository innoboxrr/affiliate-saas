<?php

namespace Innoboxrr\AffiliateSaas\Models\Filters\AffiliateProgram;

use Innoboxrr\SearchSurge\Search\Utils\Managed;

class ManagedFilter extends Managed
{

    public static function canView($query, $user, array $args = [])
    {   

        // Añadir restricciones de visibilidad
        if(method_exists($user, 'managedAffiliateProgramFilter')) {
            $query = $user->managedAffiliateProgramFilter($query, $args);
        }
        return $query;

    }

}