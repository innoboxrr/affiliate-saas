<?php

namespace Innoboxrr\AffiliateSaas\Jobs\Affiliate;

use Innoboxrr\AffiliateSaas\Models\Affiliate;
use Innoboxrr\AffiliateSaas\Services\Affiliate\Payouts\AffiliatePayoutService;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessAffiliatePayouts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected Affiliate $affiliate;
    protected Carbon $startDate;
    protected Carbon $endDate;

    /**
     * Crear una nueva instancia del Job.
     */
    public function __construct(Affiliate $affiliate, $startDate, $endDate)
    {
        $this->affiliate = $affiliate;
        $this->startDate = Carbon::parse($startDate);
        $this->endDate = Carbon::parse($endDate);
    }

    /**
     * Ejecutar el Job.
     */
    public function handle(): void
    {
        $service = new AffiliatePayoutService($this->affiliate);
        $service->calculateAndCreatePayout($this->startDate, $this->endDate);
    }
}
