<?php

namespace Innoboxrr\AffiliateSaas\Http\Requests\Affiliate;

use Innoboxrr\AffiliateSaas\Models\Affiliate;
use Innoboxrr\AffiliateSaas\Http\Resources\Models\AffiliateResource;
use Innoboxrr\AffiliateSaas\Http\Events\Affiliate\Events\CreateEvent;
use Illuminate\Foundation\Http\FormRequest;
use Innoboxrr\Support\Http\Requests\RequestFormater;
use Illuminate\Validation\Rule;

class CreateRequest extends FormRequest
{
    protected function prepareForValidation()
    {
        RequestFormater::format($this);
    }

    public function authorize()
    {
        return $this->user()->can('create', Affiliate::class);
    }

    public function rules()
    {
        return [
            'user_name' => ['required', 'string', 'min:3'],
            'user_email' => ['required', 'email'],
            
            'user_phone' => ['nullable', 'string'],
            
            'address_street' => ['nullable', 'string'],
            'address_city' => ['nullable', 'string'],
            'address_state' => ['nullable', 'string'],
            'address_country' => ['nullable', 'string'],
            'address_zip' => ['nullable', 'string'],

            'links_website' => ['nullable', 'url'],
            'links_facebook' => ['nullable', 'url'],
            'links_twitter' => ['nullable', 'url'],
            'links_instagram' => ['nullable', 'url'],
            'links_linkedin' => ['nullable', 'url'],
            'links_youtube' => ['nullable', 'url'],
            'links_tiktok' => ['nullable', 'url'],

            'financial_affiliate_type' => ['required', 'string', Rule::in(['influencer', 'empresa', 'particular'])],
            'financial_tax_id' => ['nullable', 'string'],
            'financial_comercial_name' => ['nullable', 'string'],

            'financial_payment_method' => ['required', Rule::in(['bank_transfer', 'paypal', 'stripe'])],
            'financial_paypal_email' => ['nullable', 'email'],
            'financial_bank_name' => ['nullable', 'string'],
            'financial_account_number' => ['nullable', 'string'],
            'financial_account_holder' => ['nullable', 'string'],
            'financial_stripe_account_id' => ['nullable', 'string'],

            'workspace_id' => ['required', 'integer', 'exists:workspaces,id'],

            'user_id' => [
                'required',
                'integer',
                Rule::unique('affiliates')->where(function ($query) {
                    return $query->where('workspace_id', request('workspace_id'));
                }),
            ],
        ];
    }

    public function messages()
    {
        return [];
    }

    public function attributes()
    {
        return [];
    }

    protected function passedValidation()
    {
        //
    }

    public function handle()
    {
        $affiliate = (new Affiliate)->createModel($this);
        $response = new AffiliateResource($affiliate);
        event(new CreateEvent($affiliate, $this->all(), $response));
        return $response;
    }
}
