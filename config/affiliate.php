<?php

return [

	'user_class' => 'App\Models\User',

	'workspace_class' => 'App\Models\Workspace',

	'excel_view' => 'innoboxrraffiliatesaas::excel.',

	'notification_via' => ['mail', 'database'],

	'export_disk' => 's3',

	'permissions' => [
		'affiliate-except-abilities' => [],
		'affiliate-asset-except-abilities' => [],
		'affiliate-click-except-abilities' => [],
		'affiliate-conversion-except-abilities' => [],
		'affiliate-link-except-abilities' => [],
		'affiliate-payout-except-abilities' => [],
		'affiliate-program-except-abilities' => [],
	],

	/*
	| Obsoleto desde SearchSurge v3: los filtros se localizan solos a partir
	| del namespace del modelo, preguntandole al autoloader de Composer.
	| Se deja vacio y no como clave ausente para que cualquier codigo que
	| todavia lo lea siga recibiendo un array valido.
	*/
	'search-options' => [],
	
];