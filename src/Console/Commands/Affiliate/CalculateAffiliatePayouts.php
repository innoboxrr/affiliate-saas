<?php

namespace Innoboxrr\AffiliateSaas\Console\Commands\Affiliate;

use Innoboxrr\AffiliateSaas\Models\Affiliate;
use Innoboxrr\AffiliateSaas\Jobs\Affiliate\ProcessAffiliatePayouts;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CalculateAffiliatePayouts extends Command
{
    protected $signature = 'affiliate:calculate-payouts';

    protected $description = 'Calcula las comisiones de afiliados y genera payouts agrupados por programa.';

    public function handle()
    {
        $affiliates = Affiliate::whereHas('conversions', function ($query) {
            $query->where('status', 'approved')
                  ->whereNull('affiliate_payout_id');
        })->with('program')->get();

        if ($affiliates->isEmpty()) {
            $this->warn('No hay afiliados con conversions aprobadas pendientes.');
            return 0;
        }

        // Agrupamos afiliados por programa
        $grouped = $affiliates->groupBy('program_id');

        foreach ($grouped as $programId => $group) {

            $program = $group->first()->program;

            /*
            if($program->is_active === false || $program->is_blocked) {
                $this->warn("Programa #{$programId} está inactivo o bloqueado. Payout omitido.");
                continue;
            }
            */

            $days = $program->payout_threshold_days ?? 90;

            $range = [
                'start' => now()->subDays($days + 180)->endOfDay(),
                'end' => now()->subDays($days)->endOfDay(),
            ];

            $this->info("Programa #{$programId} → Ventana de pago: {$range['start']} → {$range['end']}");

            foreach ($group as $affiliate) {

                /*
                if ($affiliate->fraud_risk || $affiliate->is_blocked_from_payouts) {
                    $this->warn("Afiliado {$affiliate->id} marcado como riesgo de fraude. Payout omitido.");
                    continue;
                }
                */

                $hasConversions = $affiliate->conversions()
                    ->whereBetween('created_at', [$range['start'], $range['end']])
                    ->where('status', 'approved')
                    ->whereNull('affiliate_payout_id')
                    ->exists();

                if (!$hasConversions) {
                    $this->line("Sin conversions válidas para el afiliado {$affiliate->id}.");
                    continue;
                }

                ProcessAffiliatePayouts::dispatch($affiliate, $range['start'], $range['end']);
                $this->info("Job enviado para Affiliate ID: {$affiliate->id}");
            }
        }

        $this->info('Todos los trabajos fueron despachados.');
        return 1;
    }
}
