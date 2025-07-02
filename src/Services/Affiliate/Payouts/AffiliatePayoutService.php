<?php

namespace Innoboxrr\AffiliateSaas\Services\Affiliate\Payouts;

use Innoboxrr\AffiliateSaas\Models\Affiliate;
use Innoboxrr\AffiliateSaas\Models\AffiliateConversion;
use Innoboxrr\AffiliateSaas\Models\AffiliatePayout;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AffiliatePayoutService
{
    protected Affiliate $affiliate;

    public function __construct(Affiliate $affiliate)
    {
        $this->affiliate = $affiliate;
    }

    public function calculateAndCreatePayout(Carbon $startDate, Carbon $endDate): void
    {
        DB::transaction(function () use ($startDate, $endDate) {
            $linkIds = $this->affiliate->links()->pluck('id');

            // Obtener conversions aprobadas, válidas, sin payout
            $conversions = AffiliateConversion::query()
                ->whereIn('affiliate_link_id', $linkIds)
                ->where('status', 'approved')
                ->where('is_test', false)
                ->whereNull('affiliate_payout_id')
                ->whereBetween('approved_at', [$startDate, $endDate])
                ->get();

            if ($conversions->isEmpty()) {
                return;
            }

            // Agrupar por moneda
            $grouped = $conversions->groupBy('currency');

            foreach ($grouped as $currency => $items) {
                $payout = AffiliatePayout::create([
                    'affiliate_id' => $this->affiliate->id,
                    'amount' => $items->sum('commission'),
                    'currency' => $currency,
                    'status' => 'pending',
                ]);

                // Asociar conversions a su payout
                $items->each(function ($conversion) use ($payout) {
                    $conversion->update(['affiliate_payout_id' => $payout->id]);
                });
            }
        });
    }
}