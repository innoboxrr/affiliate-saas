<?php

use Illuminate\Support\Facades\Route;

Route::get('policies', 'AffiliatePayoutController@policies')
	->name('policies');

Route::get('policy', 'AffiliatePayoutController@policy')
	->name('policy');

Route::get('index', 'AffiliatePayoutController@index')
	->name('index');

Route::get('show', 'AffiliatePayoutController@show')
	->name('show');

Route::post('create', 'AffiliatePayoutController@create')
	->name('create');

Route::put('update', 'AffiliatePayoutController@update')
	->name('update');

Route::delete('delete', 'AffiliatePayoutController@delete')
	->name('delete');

Route::post('restore', 'AffiliatePayoutController@restore')
	->name('restore');

Route::delete('force-delete', 'AffiliatePayoutController@forceDelete')
	->name('force.delete');

Route::post('export', 'AffiliatePayoutController@export')
	->name('export');