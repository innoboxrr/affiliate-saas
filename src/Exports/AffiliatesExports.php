<?php

namespace Innoboxrr\AffiliateSaas\Exports;

use Innoboxrr\AffiliateSaas\Models\Affiliate;
use Innoboxrr\SearchSurge\Search\Builder;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AffiliatesExports implements FromView
{

    protected $data;

    public function __construct( array $data) 
    {
        $this->data = $data;
    }

    public function view(): View
    {
        return view(
            config(
                'innoboxrraffiliatesaas.excel_view', 
                'innoboxrraffiliatesaas::excel.'
            ) . 'affiliate', 
            [
                'affiliates' => $this->getQuery(),
                'exportCols' => Affiliate::$export_cols
            ]
        );
    }

    public function getQuery()
    {   
        $builder = new Builder();
        return $builder->get(Affiliate::class, $this->data, config('affiliate.search-options'));
    }

}