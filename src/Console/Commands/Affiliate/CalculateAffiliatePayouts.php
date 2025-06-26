<?php

namespace Innoboxrr\AffiliateSaas\Console\Commands\Affiliate;

use Innoboxrr\AffiliateSaas\Models\Affiliate;
use Innoboxrr\AffiliateSaas\Jobs\Affiliate\ProcessAffiliatePayouts;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CalculateAffiliatePayouts extends Command
{
    protected $signature = 'affiliate:calculate-payouts
                            {--current-month : Calcula para el mes actual (por defecto)}
                            {--previous-month : Calcula para el mes pasado}
                            {--start-date= : Fecha de inicio personalizada (YYYY-MM-DD)}
                            {--end-date= : Fecha de fin personalizada (YYYY-MM-DD)}';

    protected $description = 'Calcula las comisiones de afiliados y genera payouts.';

    public function handle()
    {
        $range = $this->getDateRange();
        $this->info("Procesando conversions del {$range['start']} al {$range['end']}...");

        $affiliates = Affiliate::whereHas('conversions', function ($query) use ($range) {
            $query->whereBetween('affiliate_conversions.created_at', [$range['start'], $range['end']])
                  ->where('status', 'approved')
                  ->whereNull('affiliate_payout_id');
        })->get();

        if ($affiliates->isEmpty()) {
            $this->warn('No hay afiliados con conversions aprobadas en este periodo.');
            return 0;
        }

        foreach ($affiliates as $affiliate) {
            ProcessAffiliatePayouts::dispatchSync($affiliate, $range['start'], $range['end']);
            $this->info("Job enviado para Affiliate ID: {$affiliate->id}");
        }

        $this->info('Todos los trabajos fueron despachados.');
        return 1;
    }

    private function getDateRange(): array
    {
        if ($this->option('previous-month')) {
            return [
                'start' => Carbon::now()->subMonth()->startOfMonth(),
                'end' => Carbon::now()->subMonth()->endOfMonth(),
            ];
        } elseif ($this->option('start-date') && $this->option('end-date')) {
            return [
                'start' => Carbon::parse($this->option('start-date'))->startOfDay(),
                'end' => Carbon::parse($this->option('end-date'))->endOfDay(),
            ];
        } else {
            return [
                'start' => Carbon::now()->startOfMonth(),
                'end' => Carbon::now()->endOfMonth(),
            ];
        }
    }
}
