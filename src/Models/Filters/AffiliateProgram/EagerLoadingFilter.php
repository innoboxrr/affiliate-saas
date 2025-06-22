<?php

namespace Innoboxrr\AffiliateSaas\Models\Filters\AffiliateProgram;

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

        if ($data->load_workspace == 1 || $data->load_workspace === true) {
            $query->with(['workspace']);
        }

        if ($data->load_links == 1 || $data->load_links === true) {
            $query->with(['links']);
        }

        if ($data->load_assets == 1 || $data->load_assets === true) {
            $query->with(['assets']);
        }

        if ($data->load_affiliates == 1 || $data->load_affiliates === true) {
            $query->with(['affiliates']);
        }

        return $query;
    }
}
