import makeHttpRequest from 'innoboxrr-http-request'

export const API_ROUTE_PREFIX = 'api.innoboxrr.affiliatesaas.affiliate.'; // Reemplaza con la ruta adecuada

export const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute('content'); // Reemplaza con el token adecuado

export const payload = {
	user: {
		name: '',
		email: ''
	},
	address: {
		street: '',
		city: '',
		state: '',
		country: '',
		zip: ''
	},
	links: {
		website: '',
		facebook: '',
		twitter: '',
		instagram: '',
		linkedin: '',
		youtube: '',
		tiktok: ''
	},
	financial: {
		affiliate_type: 'influencer',
		tax_id: '',
		comercial_name: '',
		payment_method: 'bank_transfer',
		paypal_email: '',
		bank_name: '',
		account_number: '',
		account_holder: '',
		stripe_account_id: ''
	},
};

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
			callback: 'createAffiliate',
			icon: 'fa-plus',
			route: true,
			policy: false,
			params: {
				to: {
					name: 'AdminCreateAffiliate',
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
			id: 'payload',
			value: 'Usuario',
			sortable: false,
			html: true,
			parser: (value) => {
				if (value?.user.name) {
					return `<span class="text-primary">${value.user.name}</span>`;
				}
				return '<span class="text-muted">N/A</span>';
			}
		},
		{
			id: 'payload',
			value: 'Email',
			sortable: false,
			html: true,
			parser: (value) => {
				if (value?.user.email) {
					return `<span class="text-primary">${value.user.email}</span>`;
				}
				return '<span class="text-muted">N/A</span>';
			}
		},
		{
			id: 'payload',
			value: 'Phone',
			sortable: false,
			html: true,
			parser: (value) => {
				if (value?.user.phone) {
					return `<span class="text-primary">${value.user.phone}</span>`;
				}
				return '<span class="text-muted">N/A</span>';
			}
		},
		{
			id: 'user_id',
			value: 'User ID',
			sortable: true,
			html: false,
		},
		{
			id: 'verified_at',
			value: 'Verificado',
			sortable: true,
			html: false,
		},
		//DATA_TABLE_COLUMNS//
		/*
		{
			id: 'column',
			value: 'Column',
			sortable: true,
			html: false,
			parser: (value) => {
				return value;
			}
		},
		*/
	];
};

export const dataTableSort = () => {
	return {
		id: 'asc',
		workspace_id: 'asc',
		user_id: 'asc',
		verified_at: 'asc',
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
        affiliate_id: modelId,
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
        affiliate_id: modelId,
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
        affiliate_id: data.id,
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
