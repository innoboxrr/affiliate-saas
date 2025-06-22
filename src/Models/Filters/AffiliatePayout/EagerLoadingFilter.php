<?php

namespace Innoboxrr\AffiliateSaas\Models\Filters\AffiliatePayout;

use Illuminate\Database\Eloquent\Builder;
use Innoboxrr\SearchSurge\Search\Utils\Order;
use Innoboxrr\SearchSurge\Search\Support\DataContainer;

class EagerLoadingFilter
{
    public static function apply(Builder $query, DataContainer $data)
    {
        if ($data->load_metas == 1 || $data->load_metas === true) {
            $query->with(['metas']);
        }

        if ($data->load_affiliate == 1 || $data->load_affiliate === true) {
            $query->with(['affiliate']);
        }

        if ($data->load_conversions == 1 || $data->load_conversions === true) {
            $query->with(['conversions']);
        }

        return $query;
    }
}
