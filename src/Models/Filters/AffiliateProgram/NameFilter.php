<?php

namespace Innoboxrr\AffiliateSaas\Models\Filters\AffiliateProgram;

use Illuminate\Database\Eloquent\Builder;
use Innoboxrr\SearchSurge\Search\Utils\Order;
use Innoboxrr\SearchSurge\Search\Support\DataContainer;

class NameFilter
{

    public static function apply(Builder $query, DataContainer $data)
    {

        if ($data->name) {
            $query->where('name', 'like', '%' . $data->name . '%');
        }

        $query = Order::orderBy($query, $data, 'name');

        return $query;

    }

}
