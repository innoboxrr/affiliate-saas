<?php

namespace Innoboxrr\AffiliateSaas\Exports;

use Innoboxrr\AffiliateSaas\Models\AffiliateAsset;
use Innoboxrr\SearchSurge\Search\Builder;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AffiliateAssetsExports implements FromView
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
            ) . 'affiliate_asset', 
            [
                'affiliate_assets' => $this->getQuery(),
                'exportCols' => AffiliateAsset::$export_cols
            ]
        );
    }

    public function getQuery()
    {   
        $builder = new Builder();
        return $builder->get(AffiliateAsset::class, $this->data);
    }

}