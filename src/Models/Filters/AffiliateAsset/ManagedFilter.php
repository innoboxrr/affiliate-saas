<?php

namespace Innoboxrr\AffiliateSaas\Models\Filters\AffiliateAsset;

use Innoboxrr\SearchSurge\Search\Utils\Managed;

class ManagedFilter extends Managed
{

    public static function canView($query, $user, array $args = [])
    {   

        // Añadir restricciones de visibilidad
        if(method_exists($user, 'managedAffiliateAssetFilter')) {
            $query = $user->managedAffiliateAssetFilter($query, $args);
        }
        return $query;

    }

}