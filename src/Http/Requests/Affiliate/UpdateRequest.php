<?php

namespace Innoboxrr\AffiliateSaas\Http\Requests\Affiliate;

use Innoboxrr\AffiliateSaas\Models\Affiliate;
use Innoboxrr\AffiliateSaas\Http\Resources\Models\AffiliateResource;
use Innoboxrr\AffiliateSaas\Http\Events\Affiliate\Events\UpdateEvent;
use Illuminate\Foundation\Http\FormRequest;
use Innoboxrr\Support\Http\Requests\RequestFormater;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    protected function prepareForValidation()
    {
        RequestFormater::format($this);
    }

    public function authorize()
    {
        $affiliate = Affiliate::findOrFail($this->affiliate_id);
        return $this->user()->can('update', $affiliate);
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
        $affiliate = Affiliate::findOrFail($this->affiliate_id);
        $affiliate = $affiliate->updateModel($this);
        $response = new AffiliateResource($affiliate);
        event(new UpdateEvent($affiliate, $this->all(), $response));
        return $response;
    }
}
