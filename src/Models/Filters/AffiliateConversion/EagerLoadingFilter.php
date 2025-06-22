<?php

namespace Innoboxrr\AffiliateSaas\Models\Filters\AffiliateConversion;

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

        if ($data->load_click == 1 || $data->load_click === true) {
            $query->with(['click']);
        }

        if ($data->load_link == 1 || $data->load_link === true) {
            $query->with(['link']);
        }


        if ($data->load_affiliate == 1 || $data->load_affiliate === true) {
            $query->with(['affiliate']);
        }

        if ($data->load_program == 1 || $data->load_program === true) {
            $query->with(['program']);
        }

        return $query;
    }
}
