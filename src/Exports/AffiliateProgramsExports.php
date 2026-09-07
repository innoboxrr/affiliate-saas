<?php

namespace Innoboxrr\AffiliateSaas\Exports;

use Innoboxrr\AffiliateSaas\Models\AffiliateProgram;
use Innoboxrr\SearchSurge\Search\Builder;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AffiliateProgramsExports implements FromView
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
            ) . 'affiliate_program', 
            [
                'affiliate_programs' => $this->getQuery(),
                'exportCols' => AffiliateProgram::$export_cols
            ]
        );
    }

    public function getQuery()
    {   
        $builder = new Builder();
        // lazy() en vez de get(): un export recorre la tabla entera y
        // hidratar todas las filas a la vez es lo que revienta la memoria.
        return $builder->lazy(AffiliateProgram::class, $this->data);
    }

}