<?php

use Illuminate\Support\Facades\Route;

Route::get('policies', 'AffiliateController@policies')
	->name('policies');

Route::get('policy', 'AffiliateController@policy')
	->name('policy');

Route::get('index', 'AffiliateController@index')
	->name('index');

Route::get('show', 'AffiliateController@show')
	->name('show');

Route::post('create', 'AffiliateController@create')
	->name('create');

Route::put('update', 'AffiliateController@update')
	->name('update');

Route::delete('delete', 'AffiliateController@delete')
	->name('delete');

Route::post('restore', 'AffiliateController@restore')
	->name('restore');

Route::delete('force-delete', 'AffiliateController@forceDelete')
	->name('force.delete');

Route::post('export', 'AffiliateController@export')
	->name('export');