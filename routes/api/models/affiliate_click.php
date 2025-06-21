<?php

use Illuminate\Support\Facades\Route;

Route::get('policies', 'AffiliateClickController@policies')
	->name('policies');

Route::get('policy', 'AffiliateClickController@policy')
	->name('policy');

Route::get('index', 'AffiliateClickController@index')
	->name('index');

Route::get('show', 'AffiliateClickController@show')
	->name('show');

Route::post('create', 'AffiliateClickController@create')
	->name('create');

Route::put('update', 'AffiliateClickController@update')
	->name('update');

Route::delete('delete', 'AffiliateClickController@delete')
	->name('delete');

Route::post('restore', 'AffiliateClickController@restore')
	->name('restore');

Route::delete('force-delete', 'AffiliateClickController@forceDelete')
	->name('force.delete');

Route::post('export', 'AffiliateClickController@export')
	->name('export');