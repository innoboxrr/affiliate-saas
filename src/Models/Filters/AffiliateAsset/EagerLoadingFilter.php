<?php

namespace Innoboxrr\AffiliateSaas\Models\Filters\AffiliateAsset;

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

        if ($data->load_affiliate_program == 1 || $data->load_affiliate_program === true) {
            $query->with(['affiliateProgram']);
        }

        return $query;
    }
}
