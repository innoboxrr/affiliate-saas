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

	'search-options' => [
		'filtersPath' => 'vendor' . DIRECTORY_SEPARATOR . 'innoboxrr' . DIRECTORY_SEPARATOR . 'affiliate-saas' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'Models' . DIRECTORY_SEPARATOR . 'Filters',
		'filtersNamespace' => 'Innoboxrr\AffiliateSaas\Models\Filters',
	],
	
];