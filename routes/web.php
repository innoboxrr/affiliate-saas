<?php

use Illuminate\Support\Facades\Route;
use Innoboxrr\AffiliateSaas\Http\Controllers\AffiliateController;
use Innoboxrr\AffiliateSaas\Http\Controllers\AffiliateScriptController;
use Innoboxrr\AffiliateSaas\Http\Controllers\AffiliateTrackingController;

Route::get('client.js', [AffiliateScriptController::class, 'serve'])
    ->name('script.serve');

Route::post('track/{event}', [AffiliateTrackingController::class, 'handle'])
    ->name('track.event');

Route::get('{program}/register', [AffiliateController::class, 'register'])
    ->name('register')
    ->middleware(['web', 'guest']);