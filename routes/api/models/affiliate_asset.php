<?php

use Illuminate\Support\Facades\Route;

Route::get('policies', 'AffiliateAssetController@policies')
	->name('policies');

Route::get('policy', 'AffiliateAssetController@policy')
	->name('policy');

Route::get('index', 'AffiliateAssetController@index')
	->name('index');

Route::get('show', 'AffiliateAssetController@show')
	->name('show');

Route::post('create', 'AffiliateAssetController@create')
	->name('create');

Route::put('update', 'AffiliateAssetController@update')
	->name('update');

Route::delete('delete', 'AffiliateAssetController@delete')
	->name('delete');

Route::post('restore', 'AffiliateAssetController@restore')
	->name('restore');

Route::delete('force-delete', 'AffiliateAssetController@forceDelete')
	->name('force.delete');

Route::post('export', 'AffiliateAssetController@export')
	->name('export');