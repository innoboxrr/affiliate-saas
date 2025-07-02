<?php

namespace Innoboxrr\AffiliateSaas\Models\Filters\AffiliateConversion;

use Illuminate\Database\Eloquent\Builder;
use Innoboxrr\SearchSurge\Search\Utils\Order;
use Innoboxrr\SearchSurge\Search\Support\DataContainer;

class WorkspaceFilter
{

    public static function apply(Builder $query, DataContainer $data)
    {
        if ($data->workspace_id) {
            $query->whereHas('program', function (Builder $query) use ($data) {
                $query->where('workspace_id', $data->workspace_id);
            });
        }
        return $query;
    }

}
