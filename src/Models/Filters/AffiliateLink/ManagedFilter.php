<?php

namespace Innoboxrr\AffiliateSaas\Models\Filters\AffiliateLink;

use Innoboxrr\SearchSurge\Search\Utils\Managed;

class ManagedFilter extends Managed
{

    public static function canView($query, $user, array $args = [])
    {   

        // Añadir restricciones de visibilidad
        if(method_exists($user, 'managedAffiliateLinkFilter')) {
            $query = $user->managedAffiliateLinkFilter($query, $user, $args);
        }
        return $query;

    }

}