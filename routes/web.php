<?php

use Illuminate\Support\Facades\Route;

use Innoboxrr\AffiliateSaas\Http\Controllers\AffiliateScriptController;
use Innoboxrr\AffiliateSaas\Http\Controllers\AffiliateTrackingController;

Route::get('/affiliate-script.js', [AffiliateScriptController::class, 'serve'])
    ->name('affiliate.script.serve');

Route::get('/track/click', [AffiliateTrackingController::class, 'handle']);