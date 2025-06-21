<?php

use Illuminate\Support\Facades\Route;

Route::get('policies', 'AffiliateConversionController@policies')
	->name('policies');

Route::get('policy', 'AffiliateConversionController@policy')
	->name('policy');

Route::get('index', 'AffiliateConversionController@index')
	->name('index');

Route::get('show', 'AffiliateConversionController@show')
	->name('show');

Route::post('create', 'AffiliateConversionController@create')
	->name('create');

Route::put('update', 'AffiliateConversionController@update')
	->name('update');

Route::delete('delete', 'AffiliateConversionController@delete')
	->name('delete');

Route::post('restore', 'AffiliateConversionController@restore')
	->name('restore');

Route::delete('force-delete', 'AffiliateConversionController@forceDelete')
	->name('force.delete');

Route::post('export', 'AffiliateConversionController@export')
	->name('export');