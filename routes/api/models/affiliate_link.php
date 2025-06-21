<?php

use Illuminate\Support\Facades\Route;

Route::get('policies', 'AffiliateLinkController@policies')
	->name('policies');

Route::get('policy', 'AffiliateLinkController@policy')
	->name('policy');

Route::get('index', 'AffiliateLinkController@index')
	->name('index');

Route::get('show', 'AffiliateLinkController@show')
	->name('show');

Route::post('create', 'AffiliateLinkController@create')
	->name('create');

Route::put('update', 'AffiliateLinkController@update')
	->name('update');

Route::delete('delete', 'AffiliateLinkController@delete')
	->name('delete');

Route::post('restore', 'AffiliateLinkController@restore')
	->name('restore');

Route::delete('force-delete', 'AffiliateLinkController@forceDelete')
	->name('force.delete');

Route::post('export', 'AffiliateLinkController@export')
	->name('export');