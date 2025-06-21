<?php

namespace Innoboxrr\AffiliateSaas\Exports;

use Innoboxrr\AffiliateSaas\Models\AffiliatePayout;
use Innoboxrr\SearchSurge\Search\Builder;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AffiliatePayoutsExports implements FromView
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
            ) . 'affiliate_payout', 
            [
                'affiliate_payouts' => $this->getQuery(),
                'exportCols' => AffiliatePayout::$export_cols
            ]
        );
    }

    public function getQuery()
    {   
        $builder = new Builder();
        return $builder->get(AffiliatePayout::class, $this->data);
    }

}