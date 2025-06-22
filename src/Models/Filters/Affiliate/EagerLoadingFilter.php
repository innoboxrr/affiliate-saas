<?php

namespace Innoboxrr\AffiliateSaas\Models\Filters\Affiliate;

use Illuminate\Database\Eloquent\Builder;
use Innoboxrr\SearchSurge\Search\Utils\Order;
use Innoboxrr\SearchSurge\Search\Support\DataContainer;

class EagerLoadingFilter
{

    public static function apply(Builder $query, DataContainer $data)
    {

        if ($data->load_user == 1 || $data->load_user == true) {

            $query->with(['user']);

        }

        if ($data->load_workspace == 1 || $data->load_workspace == true) {

            $query->with(['workspace']);

        }

        if ($data->load_links == 1 || $data->load_links == true) {

            $query->with(['links']);

        }

        if ($data->load_payouts == 1 || $data->load_payouts == true) {

            $query->with(['payouts']);

        }

        if ($data->load_metas == 1 || $data->load_metas == true) {

            $query->with(['metas']);

        }

        if ($data->load_conversions == 1 || $data->load_conversions == true) {

            $query->with(['conversions']);

        }

        return $query;

    }

}
