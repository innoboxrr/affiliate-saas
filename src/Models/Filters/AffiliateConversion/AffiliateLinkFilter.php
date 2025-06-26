<?php

namespace Innoboxrr\AffiliateSaas\Models\Filters\AffiliateConversion;

use Illuminate\Database\Eloquent\Builder;
use Innoboxrr\SearchSurge\Search\Utils\Order;
use Innoboxrr\SearchSurge\Search\Support\DataContainer;

class AffiliateLinkFilter
{

    public static function apply(Builder $query, DataContainer $data)
    {

        if ($data->affiliate_link_id) {

            $query->where('affiliate_link_id', $data->affiliate_link_id);

        }

        $query = Order::orderBy($query, $data, 'affiliate_link_id');

        return $query;

    }

}
