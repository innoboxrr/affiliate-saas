import makeHttpRequest from 'innoboxrr-http-request'

export const API_ROUTE_PREFIX = 'api.innoboxrr.affiliatesaas.affiliate_payout.'; // Reemplaza con la ruta adecuada

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
			callback: 'createAffiliatePayout',
			icon: 'fa-plus',
			route: true,
			policy: false,
			params: {
				to: {
					name: 'AdminCreateAffiliatePayout',
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
			id: 'affiliate_id',
			value: 'Afiliado',
			sortable: true,
			html: false,
		},
		{
			id: 'processor',
			value: 'Procesador',
			sortable: true,
			html: true,
			parser: (value) => {
				return `<span class="text-xs px-2 py-1 bg-indigo-100 text-indigo-800 rounded dark:bg-indigo-900 dark:text-indigo-300">${value}</span>`;
			}
		},
		{
			id: 'status',
			value: 'Estado',
			sortable: true,
			html: true,
			parser: (value) => {
				const color = value === 'completed' ? 'green' : value === 'failed' ? 'red' : 'gray';
				return `<span class="text-xs px-2 py-1 bg-${color}-100 text-${color}-800 rounded dark:bg-${color}-900 dark:text-${color}-300">${value}</span>`;
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
			id: 'paid_at',
			value: 'Pagado el',
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
		affiliate_id: 'asc',
		processor: 'asc',
		status: 'asc',
		amount: 'asc',
		currency: 'asc',
		paid_at: 'asc',
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
        affiliate_payout_id: modelId,
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
        affiliate_payout_id: modelId,
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
        affiliate_payout_id: data.id,
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
