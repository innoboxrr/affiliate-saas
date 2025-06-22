import makeHttpRequest from 'innoboxrr-http-request'

export const API_ROUTE_PREFIX = 'api.innoboxrr.affiliatesaas.affiliate_conversion.'; // Reemplaza con la ruta adecuada

export const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute('content'); // Reemplaza con el token adecuado

export let filters = {}

export const setFilters = (newFilters = {}) => {
	filters = {
		...filters,
		...newFilters,
	}
	return filters;
};

export const getFilters = () => {
	return filters;
};

export const resetFilters = () => {
	filters = {};
	return filters;
};

export const crudActions = () => {

	return [
		{
			id: 'create',
			name: 'Create',
			callback: 'createAffiliateConversion',
			icon: 'fa-plus',
			route: true,
			policy: false,
			params: {
				to: {
					name: 'AdminCreateAffiliateConversion',
					params: {}
				}
			}
		},
		{
			id: 'export',
			name: 'Export',
			callback: 'exportModel',
			icon: 'fa-download',
			route: false,
			policy: false,
			params: {}
		}
	];
};

export const dataTableHead = () => {
	return [
		{
			id: 'id',
			value: 'ID',
			sortable: true,
			html: false,
		},
		{
			id: 'status',
			value: 'Estado',
			sortable: true,
			html: true,
			parser: (value) => {
				const color = value === 'approved' ? 'green' : value === 'rejected' ? 'red' : 'gray';
				return `<span class="px-2 py-1 text-xs font-semibold text-${color}-800 bg-${color}-100 rounded dark:bg-${color}-900 dark:text-${color}-300">${value}</span>`;
			}
		},
		{
			id: 'amount',
			value: 'Monto',
			sortable: true,
			html: false,
		},
		{
			id: 'currency',
			value: 'Moneda',
			sortable: true,
			html: false,
		},
		{
			id: 'commission',
			value: 'Comisión',
			sortable: true,
			html: false,
		},
		{
			id: 'event_type',
			value: 'Tipo de Evento',
			sortable: true,
			html: false,
		},
		{
			id: 'is_test',
			value: 'Test',
			sortable: true,
			html: true,
			parser: (value) => {
				return value
					? `<span class="text-xs px-2 py-1 rounded bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300">Sí</span>`
					: `<span class="text-xs px-2 py-1 rounded bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300">No</span>`;
			}
		},
		{
			id: 'external_order_id',
			value: 'Orden Externa',
			sortable: true,
			html: false,
		},
		{
			id: 'external_user_id',
			value: 'Usuario Externo',
			sortable: true,
			html: false,
		},
		{
			id: 'affiliate_link_id',
			value: 'ID Link',
			sortable: true,
			html: false,
		},
		{
			id: 'affiliate_click_id',
			value: 'ID Click',
			sortable: true,
			html: false,
		},
		{
			id: 'affiliate_payout_id',
			value: 'ID Pago',
			sortable: true,
			html: false,
		},
		{
			id: 'approved_by',
			value: 'Aprobado por',
			sortable: true,
			html: false,
		},
		{
			id: 'approved_at',
			value: 'Aprobado el',
			sortable: true,
			html: false,
		},
		{
			id: 'created_at',
			value: 'Creado',
			sortable: true,
			html: false,
		},
		{
			id: 'updated_at',
			value: 'Actualizado',
			sortable: true,
			html: false,
		},
		{
			id: 'deleted_at',
			value: 'Eliminado',
			sortable: true,
			html: false,
		},
		//DATA_TABLE_COLUMNS//
	];
};

export const dataTableSort = () => {
	return {
		id: 'asc',
		status: 'asc',
		amount: 'asc',
		currency: 'asc',
		commission: 'asc',
		event_type: 'asc',
		is_test: 'asc',
		external_order_id: 'asc',
		external_user_id: 'asc',
		affiliate_link_id: 'asc',
		affiliate_click_id: 'asc',
		affiliate_payout_id: 'asc',
		approved_by: 'asc',
		approved_at: 'asc',
		created_at: 'asc',
		updated_at: 'asc',
		deleted_at: 'asc',
		//DATA_TABLE_SORT//
	};
};


export const getPolicies = (modelId = null) => {
    return makeHttpRequest('get', route(API_ROUTE_PREFIX + 'policies'), {
        _token: CSRF_TOKEN,
        id: modelId,
    }, {}, 3, 1500);
};

export const getPolicy = (policy, modelId = null) => {
    return makeHttpRequest('get', route(API_ROUTE_PREFIX + 'policy'), {
        _token: CSRF_TOKEN,
        policy: policy,
        id: modelId,
    }, {}, 3, 1500);
};

export const showModel = (modelId, loadRelations = [], loadCounts = [], data = {}) => {
    return makeHttpRequest('get', route(API_ROUTE_PREFIX + 'show'), {
        _token: CSRF_TOKEN,
        affiliate_conversion_id: modelId,
        load_relations: loadRelations,
        load_counts: loadCounts,
        ...data,
    }, {}, 3, 1500);
};

export const indexModel = (filters = {}) => {
    return makeHttpRequest('get', route(API_ROUTE_PREFIX + 'index'), {
        _token: CSRF_TOKEN,
        ...filters,
    }, {}, 3, 1500);
};

export const createModel = (data) => {
    return makeHttpRequest('post', route(API_ROUTE_PREFIX + 'create'), {
        _token: CSRF_TOKEN,
        ...data,
    }, {}, 1, 1500);
};

export const updateModel = (modelId, data) => {
    return makeHttpRequest('put', route(API_ROUTE_PREFIX + 'update'), {
        _token: CSRF_TOKEN,
        ...data,
        affiliate_conversion_id: modelId,
    }, {}, 1, 1500);
};

export const deleteModel = (data) => {
    const confirmOptions = {
        title: 'Confirm operation',
        text: 'Are you sure you want to delete this item?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: t('Yes, delete'),
    };
    return makeHttpRequest('post', route(API_ROUTE_PREFIX + 'delete'), {
        _token: CSRF_TOKEN,
        _method: 'DELETE',
        affiliate_conversion_id: data.id,
    }, {}, 3, 1500, confirmOptions);
};

export const exportModel = (data) => {
    const confirmOptions = {
        title: 'Confirm operation',
        text: 'Are you sure you want to export this item?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: t('Yes, continue'),
    };
    return makeHttpRequest('post', route(API_ROUTE_PREFIX + 'export'), {
        _token: CSRF_TOKEN,
        ...data,
    }, {}, 3, 1500, confirmOptions);
};
