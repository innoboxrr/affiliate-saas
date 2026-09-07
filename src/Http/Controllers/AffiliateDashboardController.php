<?php

declare(strict_types=1);

namespace Innoboxrr\AffiliateSaas\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Innoboxrr\AffiliateSaas\Models\AffiliateProgram;
use Innoboxrr\AffiliateSaas\Models\Affiliate;
use Innoboxrr\AffiliateSaas\Models\AffiliateClick;
use Innoboxrr\AffiliateSaas\Models\AffiliateConversion;
use Innoboxrr\AffiliateSaas\Models\AffiliatePayout;

class AffiliateDashboardController extends Controller
{
    /**
     * Get owner dashboard statistics
     */
    public function ownerStats(Request $request): JsonResponse
    {
        $workspaceId = $request->input('app_workspace_id');
        $currentMonth = Carbon::now()->startOfMonth();
        $lastMonth = Carbon::now()->subMonth()->startOfMonth();
        $lastMonthEnd = Carbon::now()->subMonth()->endOfMonth();

        // Active programs count
        $activeProgramsQuery = AffiliateProgram::where('workspace_id', $workspaceId);

        $activeProgramsCount = (clone $activeProgramsQuery)
            ->count();

        $activeProgramsLastMonth = (clone $activeProgramsQuery)
            ->where('created_at', '<=', $lastMonthEnd)
            ->count();

        $programsPercentage = $activeProgramsLastMonth > 0
            ? round((($activeProgramsCount - $activeProgramsLastMonth) / $activeProgramsLastMonth) * 100, 1)
            : 0;

        // Registered affiliates count
        $affiliatesCount = Affiliate::whereHas('program', function ($q) use ($workspaceId) {
            $q->where('workspace_id', $workspaceId);
        })->count();

        $affiliatesThisMonth = Affiliate::whereHas('program', function ($q) use ($workspaceId) {
            $q->where('workspace_id', $workspaceId);
        })->where('created_at', '>=', $currentMonth)->count();

        $affiliatesLastMonth = Affiliate::whereHas('program', function ($q) use ($workspaceId) {
            $q->where('workspace_id', $workspaceId);
        })
            ->whereBetween('created_at', [$lastMonth, $lastMonthEnd])
            ->count();

        $affiliatesPercentage = $affiliatesLastMonth > 0
            ? round((($affiliatesThisMonth - $affiliatesLastMonth) / $affiliatesLastMonth) * 100, 1)
            : 0;

        // Generated leads (conversions) count
        $leadsCount = AffiliateConversion::whereHas('link.affiliate.program', function ($q) use ($workspaceId) {
            $q->where('workspace_id', $workspaceId);
        })->count();

        $leadsThisMonth = AffiliateConversion::whereHas('link.affiliate.program', function ($q) use ($workspaceId) {
            $q->where('workspace_id', $workspaceId);
        })->where('created_at', '>=', $currentMonth)->count();

        $leadsLastMonth = AffiliateConversion::whereHas('link.affiliate.program', function ($q) use ($workspaceId) {
            $q->where('workspace_id', $workspaceId);
        })
            ->whereBetween('created_at', [$lastMonth, $lastMonthEnd])
            ->count();

        $leadsPercentage = $leadsLastMonth > 0
            ? round((($leadsThisMonth - $leadsLastMonth) / $leadsLastMonth) * 100, 1)
            : 0;

        // Paid commissions
        $commissionsQuery = AffiliatePayout::whereHas('affiliate.program', function ($q) use ($workspaceId) {
            $q->where('workspace_id', $workspaceId);
        })
            ->where('status', 'paid');

        $commissionsPaid = (clone $commissionsQuery)
            ->sum('amount');

        $commissionsPaidThisMonth = (clone $commissionsQuery)
            ->where('paid_at', '>=', $currentMonth)
            ->sum('amount');

        $commissionsPaidLastMonth = (clone $commissionsQuery)
            ->whereBetween('paid_at', [$lastMonth, $lastMonthEnd])
            ->sum('amount');

        $commissionsPercentage = $commissionsPaidLastMonth > 0
            ? round((($commissionsPaidThisMonth - $commissionsPaidLastMonth) / $commissionsPaidLastMonth) * 100, 1)
            : 0;

        return response()->json([
            'cards' => [
                [
                    'title' => 'Programas Activos',
                    'icon' => 'fa-solid fa-diagram-project',
                    'count' => $activeProgramsCount,
                    'percentage' => $programsPercentage,
                    'percentageText' => 'vs mes anterior',
                ],
                [
                    'title' => 'Afiliados Registrados',
                    'icon' => 'fa-solid fa-user-group',
                    'count' => $affiliatesCount,
                    'percentage' => $affiliatesPercentage,
                    'percentageText' => 'nuevos este mes',
                ],
                [
                    'title' => 'Leads Generados',
                    'icon' => 'fa-solid fa-bullseye',
                    'count' => $leadsCount,
                    'percentage' => $leadsPercentage,
                    'percentageText' => 'vs mes anterior',
                ],
                [
                    'title' => 'Comisiones Pagadas',
                    'icon' => 'fa-solid fa-sack-dollar',
                    'count' => round($commissionsPaid, 2),
                    'percentage' => $commissionsPercentage,
                    'percentageText' => 'vs mes anterior',
                ],
            ],
        ]);
    }

    /**
     * Get owner dashboard charts data
     */
    public function ownerCharts(Request $request): JsonResponse
    {
        $workspaceId = $request->input('app_workspace_id');
        $period = $request->input('period', '30days');
        [$startDate, $endDate] = $this->getDateRange($period);

        // Clicks over time
        $clicks = AffiliateClick::whereHas('link.affiliate.program', function ($q) use ($workspaceId) {
            $q->where('workspace_id', $workspaceId);
        })
            ->whereBetween('created_at', [$startDate, $endDate])
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as count'))
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->map(function ($item) {
                return [
                    'date' => $item->date,
                    'count' => (int) $item->count,
                ];
            });

        // Conversions over time
        $conversions = AffiliateConversion::whereHas('link.affiliate.program', function ($q) use ($workspaceId) {
            $q->where('workspace_id', $workspaceId);
        })
            ->whereBetween('created_at', [$startDate, $endDate])
            ->select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('COUNT(*) as count'),
                DB::raw('SUM(commission) as total_commission')
            )
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->map(function ($item) {
                return [
                    'date' => $item->date,
                    'count' => (int) $item->count,
                    'total_commission' => (float) $item->total_commission,
                ];
            });

        // Top affiliates by conversions
        $topAffiliates = Affiliate::whereHas('program', function ($q) use ($workspaceId) {
            $q->where('workspace_id', $workspaceId);
        })
            ->withCount(['links as total_conversions' => function ($query) use ($startDate, $endDate) {
                $query->select(DB::raw('COUNT(affiliate_conversions.id)'))
                    ->join('affiliate_conversions', 'affiliate_links.id', '=', 'affiliate_conversions.affiliate_link_id')
                    ->whereBetween('affiliate_conversions.created_at', [$startDate, $endDate]);
            }])
            ->withSum(['links as total_commission' => function ($query) use ($startDate, $endDate) {
                $query->select(DB::raw('SUM(affiliate_conversions.commission)'))
                    ->join('affiliate_conversions', 'affiliate_links.id', '=', 'affiliate_conversions.affiliate_link_id')
                    ->whereBetween('affiliate_conversions.created_at', [$startDate, $endDate]);
            }], 'commission')
            ->orderByDesc('total_conversions')
            ->limit(10)
            ->get()
            ->map(function ($affiliate) {
                return [
                    'id' => $affiliate->id,
                    'name' => $affiliate->user->name ?? 'N/A',
                    'email' => $affiliate->user->email ?? 'N/A',
                    'conversions' => $affiliate->total_conversions ?? 0,
                    'commission' => (float) ($affiliate->total_commission ?? 0),
                ];
            });

        return response()->json([
            'clicks' => $clicks,
            'conversions' => $conversions,
            'topAffiliates' => $topAffiliates,
        ]);
    }

    /**
     * Get affiliate personal statistics
     */
    public function affiliateStats(Request $request): JsonResponse
    {
        $userId = $request->user()->id;
        $currentMonth = Carbon::now()->startOfMonth();
        $lastMonth = Carbon::now()->subMonth()->startOfMonth();
        $lastMonthEnd = Carbon::now()->subMonth()->endOfMonth();

        // Active affiliates count (programs the user is affiliated with)
        $affiliatesQuery = Affiliate::where('user_id', $userId)
            ->whereNull('deleted_at');

        $activeAffiliatesCount = (clone $affiliatesQuery)
            ->whereNotNull('verified_at')
            ->count();

        $activeAffiliatesLastMonth = (clone $affiliatesQuery)
            ->whereNotNull('verified_at')
            ->where('created_at', '<=', $lastMonthEnd)
            ->count();

        $affiliatesPercentage = $activeAffiliatesLastMonth > 0
            ? round((($activeAffiliatesCount - $activeAffiliatesLastMonth) / $activeAffiliatesLastMonth) * 100, 1)
            : 0;

        // Registered clicks count
        $clicksCount = AffiliateClick::whereHas('link.affiliate', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })->count();

        $clicksThisMonth = AffiliateClick::whereHas('link.affiliate', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })->where('created_at', '>=', $currentMonth)->count();

        $clicksLastMonth = AffiliateClick::whereHas('link.affiliate', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })
            ->whereBetween('created_at', [$lastMonth, $lastMonthEnd])
            ->count();

        $clicksPercentage = $clicksLastMonth > 0
            ? round((($clicksThisMonth - $clicksLastMonth) / $clicksLastMonth) * 100, 1)
            : 0;

        // Generated leads (conversions) count
        $leadsCount = AffiliateConversion::whereHas('link.affiliate', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })->count();

        $leadsThisMonth = AffiliateConversion::whereHas('link.affiliate', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })->where('created_at', '>=', $currentMonth)->count();

        $leadsLastMonth = AffiliateConversion::whereHas('link.affiliate', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })
            ->whereBetween('created_at', [$lastMonth, $lastMonthEnd])
            ->count();

        $leadsPercentage = $leadsLastMonth > 0
            ? round((($leadsThisMonth - $leadsLastMonth) / $leadsLastMonth) * 100, 1)
            : 0;

        // Total commissions
        $totalCommissions = AffiliateConversion::whereHas('link.affiliate', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })->sum('commission');

        $commissionsThisMonth = AffiliateConversion::whereHas('link.affiliate', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })->where('created_at', '>=', $currentMonth)->sum('commission');

        $commissionsLastMonth = AffiliateConversion::whereHas('link.affiliate', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })
            ->whereBetween('created_at', [$lastMonth, $lastMonthEnd])
            ->sum('commission');

        $commissionsPercentage = $commissionsLastMonth > 0
            ? round((($commissionsThisMonth - $commissionsLastMonth) / $commissionsLastMonth) * 100, 1)
            : 0;

        return response()->json([
            'cards' => [
                [
                    'title' => 'Afiliados Activos',
                    'icon' => 'fa-solid fa-user-check',
                    'count' => $activeAffiliatesCount,
                    'percentage' => $affiliatesPercentage,
                    'percentageText' => 'vs mes anterior',
                ],
                [
                    'title' => 'Clics Registrados',
                    'icon' => 'fa-solid fa-mouse-pointer',
                    'count' => $clicksCount,
                    'percentage' => $clicksPercentage,
                    'percentageText' => 'vs mes anterior',
                ],
                [
                    'title' => 'Leads Generados',
                    'icon' => 'fa-solid fa-user-plus',
                    'count' => $leadsCount,
                    'percentage' => $leadsPercentage,
                    'percentageText' => 'vs mes anterior',
                ],
                [
                    'title' => 'Comisiones Totales',
                    'icon' => 'fa-solid fa-dollar-sign',
                    'count' => round($totalCommissions, 2),
                    'percentage' => $commissionsPercentage,
                    'percentageText' => 'crecimiento mensual',
                ],
            ],
        ]);
    }

    /**
     * Get affiliate personal charts data
     */
    public function affiliateCharts(Request $request): JsonResponse
    {
        $userId = $request->user()->id;
        $period = $request->input('period', '30days');
        [$startDate, $endDate] = $this->getDateRange($period);

        // Clicks over time
        $clicks = AffiliateClick::whereHas('link.affiliate', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })
            ->whereBetween('created_at', [$startDate, $endDate])
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as count'))
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->map(function ($item) {
                return [
                    'date' => $item->date,
                    'count' => (int) $item->count,
                ];
            });

        // Conversions over time
        $conversions = AffiliateConversion::whereHas('link.affiliate', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })
            ->whereBetween('created_at', [$startDate, $endDate])
            ->select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('COUNT(*) as count'),
                DB::raw('SUM(commission) as total_commission')
            )
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->map(function ($item) {
                return [
                    'date' => $item->date,
                    'count' => (int) $item->count,
                    'total_commission' => (float) $item->total_commission,
                ];
            });

        // Program performance
        $programPerformance = Affiliate::where('user_id', $userId)
            ->with('program:id,name')
            ->withCount(['links as total_clicks' => function ($query) use ($startDate, $endDate) {
                $query->select(DB::raw('COUNT(affiliate_clicks.id)'))
                    ->join('affiliate_clicks', 'affiliate_links.id', '=', 'affiliate_clicks.affiliate_link_id')
                    ->whereBetween('affiliate_clicks.created_at', [$startDate, $endDate]);
            }])
            ->withCount(['links as total_conversions' => function ($query) use ($startDate, $endDate) {
                $query->select(DB::raw('COUNT(affiliate_conversions.id)'))
                    ->join('affiliate_conversions', 'affiliate_links.id', '=', 'affiliate_conversions.affiliate_link_id')
                    ->whereBetween('affiliate_conversions.created_at', [$startDate, $endDate]);
            }])
            ->withSum(['links as total_commission' => function ($query) use ($startDate, $endDate) {
                $query->select(DB::raw('SUM(affiliate_conversions.commission)'))
                    ->join('affiliate_conversions', 'affiliate_links.id', '=', 'affiliate_conversions.affiliate_link_id')
                    ->whereBetween('affiliate_conversions.created_at', [$startDate, $endDate]);
            }], 'commission')
            ->get()
            ->map(function ($affiliate) {
                return [
                    'program_id' => $affiliate->program_id,
                    'program_name' => $affiliate->program->name ?? 'N/A',
                    'clicks' => $affiliate->total_clicks ?? 0,
                    'conversions' => $affiliate->total_conversions ?? 0,
                    'commission' => (float) ($affiliate->total_commission ?? 0),
                    'conversion_rate' => $affiliate->total_clicks > 0
                        ? round((($affiliate->total_conversions ?? 0) / $affiliate->total_clicks) * 100, 2)
                        : 0,
                ];
            });

        return response()->json([
            'clicks' => $clicks,
            'conversions' => $conversions,
            'programPerformance' => $programPerformance,
        ]);
    }

    /**
     * Get owner payout statistics
     */
    public function ownerPayoutStats(Request $request): JsonResponse
    {
        $workspaceId = $request->input('app_workspace_id');

        $payoutsQuery = AffiliatePayout::whereHas('affiliate.program', function ($q) use ($workspaceId) {
            $q->where('workspace_id', $workspaceId);
        });

        $totalPaid = (clone $payoutsQuery)->where('status', 'paid')->sum('amount');
        $pendingCount = (clone $payoutsQuery)->where('status', 'pending')->count();
        $completedCount = (clone $payoutsQuery)->where('status', 'paid')->count();
        $failedCount = (clone $payoutsQuery)->where('status', 'failed')->count();

        $recentPayouts = (clone $payoutsQuery)
            ->with(['affiliate.user:id,name,email', 'affiliate.program:id,name'])
            ->orderByDesc('created_at')
            ->limit(10)
            ->get()
            ->map(function ($payout) {
                return [
                    'id' => $payout->id,
                    'affiliate_name' => $payout->affiliate->user->name ?? 'N/A',
                    'affiliate_email' => $payout->affiliate->user->email ?? 'N/A',
                    'program_name' => $payout->affiliate->program->name ?? 'N/A',
                    'amount' => round((float) $payout->amount, 2),
                    'currency' => $payout->currency ?? 'USD',
                    'status' => $payout->status,
                    'processor' => $payout->processor ?? 'N/A',
                    'created_at' => $payout->created_at->toDateTimeString(),
                    'paid_at' => $payout->paid_at?->toDateTimeString(),
                ];
            });

        return response()->json([
            'cards' => [
                [
                    'title' => 'Total Pagado',
                    'icon' => 'fa-solid fa-money-bill-wave',
                    'count' => round($totalPaid, 2),
                    'percentage' => 0,
                    'percentageText' => 'acumulado',
                ],
                [
                    'title' => 'Pagos Pendientes',
                    'icon' => 'fa-solid fa-clock',
                    'count' => $pendingCount,
                    'percentage' => 0,
                    'percentageText' => 'por procesar',
                ],
                [
                    'title' => 'Pagos Completados',
                    'icon' => 'fa-solid fa-circle-check',
                    'count' => $completedCount,
                    'percentage' => 0,
                    'percentageText' => 'exitosos',
                ],
                [
                    'title' => 'Pagos Fallidos',
                    'icon' => 'fa-solid fa-circle-xmark',
                    'count' => $failedCount,
                    'percentage' => 0,
                    'percentageText' => 'con error',
                ],
            ],
            'recent_payouts' => $recentPayouts,
        ]);
    }

    /**
     * Get date range based on period
     */
    private function getDateRange(string $period): array
    {
        $endDate = Carbon::now();

        $startDate = match ($period) {
            '7days' => Carbon::now()->subDays(7),
            '30days' => Carbon::now()->subDays(30),
            '90days' => Carbon::now()->subDays(90),
            'thisMonth' => Carbon::now()->startOfMonth(),
            'lastMonth' => Carbon::now()->subMonth()->startOfMonth(),
            'thisYear' => Carbon::now()->startOfYear(),
            default => Carbon::now()->subDays(30),
        };

        if ($period === 'lastMonth') {
            $endDate = Carbon::now()->subMonth()->endOfMonth();
        }

        return [$startDate, $endDate];
    }
}
