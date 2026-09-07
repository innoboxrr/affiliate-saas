<?php

use Illuminate\Support\Facades\Route;

// Dashboard del propietario (cuando tengo afiliados)
Route::get('owner/stats', 'AffiliateDashboardController@ownerStats')
    ->name('owner.stats');

Route::get('owner/charts', 'AffiliateDashboardController@ownerCharts')
    ->name('owner.charts');

Route::get('owner/payout-stats', 'AffiliateDashboardController@ownerPayoutStats')
    ->name('owner.payout-stats');

// Dashboard del afiliado (cuando soy afiliado de un tercero)
Route::get('affiliate/stats', 'AffiliateDashboardController@affiliateStats')
    ->name('affiliate.stats');

Route::get('affiliate/charts', 'AffiliateDashboardController@affiliateCharts')
    ->name('affiliate.charts');
