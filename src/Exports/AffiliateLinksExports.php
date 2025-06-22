<?php

namespace Innoboxrr\AffiliateSaas\Exports;

use Innoboxrr\AffiliateSaas\Models\AffiliateLink;
use Innoboxrr\SearchSurge\Search\Builder;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AffiliateLinksExports implements FromView
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
            ) . 'affiliate_link', 
            [
                'affiliate_links' => $this->getQuery(),
                'exportCols' => AffiliateLink::$export_cols
            ]
        );
    }

    public function getQuery()
    {   
        $builder = new Builder();
        return $builder->get(AffiliateLink::class, $this->data, config('affiliate.search-options'));
    }

}