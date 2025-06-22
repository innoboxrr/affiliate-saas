<?php

namespace Innoboxrr\AffiliateSaas\Models\Filters\AffiliateClick;

use Illuminate\Database\Eloquent\Builder;
use Innoboxrr\SearchSurge\Search\Utils\Order;
use Innoboxrr\SearchSurge\Search\Support\DataContainer;

class EagerLoadingFilter
{
    public static function apply(Builder $query, DataContainer $data)
    {
        if ($data->load_link == 1 || $data->load_link === true) {
            $query->with(['link']);
        }

        if ($data->load_conversions == 1 || $data->load_conversions === true) {
            $query->with(['conversions']);
        }

        return $query;
    }
}
