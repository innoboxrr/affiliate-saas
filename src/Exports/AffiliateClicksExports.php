<?php

namespace Innoboxrr\AffiliateSaas\Exports;

use Innoboxrr\AffiliateSaas\Models\AffiliateClick;
use Innoboxrr\SearchSurge\Search\Builder;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AffiliateClicksExports implements FromView
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
            ) . 'affiliate_click', 
            [
                'affiliate_clicks' => $this->getQuery(),
                'exportCols' => AffiliateClick::$export_cols
            ]
        );
    }

    public function getQuery()
    {   
        $builder = new Builder();
        return $builder->get(AffiliateClick::class, $this->data);
    }

}