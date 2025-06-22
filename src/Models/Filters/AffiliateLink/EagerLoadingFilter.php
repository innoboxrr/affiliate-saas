<?php

namespace Innoboxrr\AffiliateSaas\Models\Filters\AffiliateLink;

use Illuminate\Database\Eloquent\Builder;
use Innoboxrr\SearchSurge\Search\Utils\Order;
use Innoboxrr\SearchSurge\Search\Support\DataContainer;

class EagerLoadingFilter
{
    public static function apply(Builder $query, DataContainer $data)
    {
        if ($data->load_affiliate == 1 || $data->load_affiliate === true) {
            $query->with(['affiliate']);
        }

        if ($data->load_program == 1 || $data->load_program === true) {
            $query->with(['program']);
        }

        if ($data->load_clicks == 1 || $data->load_clicks === true) {
            $query->with(['clicks']);
        }

        if ($data->load_conversions == 1 || $data->load_conversions === true) {
            $query->with(['conversions']);
        }

        return $query;
    }
}
