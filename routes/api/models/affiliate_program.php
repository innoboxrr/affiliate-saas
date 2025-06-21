<?php

use Illuminate\Support\Facades\Route;

Route::get('policies', 'AffiliateProgramController@policies')
	->name('policies');

Route::get('policy', 'AffiliateProgramController@policy')
	->name('policy');

Route::get('index', 'AffiliateProgramController@index')
	->name('index');

Route::get('show', 'AffiliateProgramController@show')
	->name('show');

Route::post('create', 'AffiliateProgramController@create')
	->name('create');

Route::put('update', 'AffiliateProgramController@update')
	->name('update');

Route::delete('delete', 'AffiliateProgramController@delete')
	->name('delete');

Route::post('restore', 'AffiliateProgramController@restore')
	->name('restore');

Route::delete('force-delete', 'AffiliateProgramController@forceDelete')
	->name('force.delete');

Route::post('export', 'AffiliateProgramController@export')
	->name('export');