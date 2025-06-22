<?php

namespace Innoboxrr\AffiliateSaas\Http\Requests\Affiliate;

use Innoboxrr\AffiliateSaas\Models\Affiliate;
use Innoboxrr\AffiliateSaas\Http\Resources\Models\AffiliateResource;
use Innoboxrr\AffiliateSaas\Http\Events\Affiliate\Events\UpdateEvent;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    protected function prepareForValidation()
    {
        //
    }

    public function authorize()
    {
        $affiliate = Affiliate::findOrFail($this->affiliate_id);
        return $this->user()->can('update', $affiliate);
    }

    public function rules()
    {
        return [
            'affiliate_id' => ['required', 'numeric'],
            'name' => ['sometimes', 'string', 'min:3'],
            'email' => ['sometimes', 'email'],
            'phone' => ['nullable', 'string'],
            'address' => ['nullable', 'string'],
            'city' => ['nullable', 'string'],
            'state' => ['nullable', 'string'],
            'country' => ['nullable', 'string'],
            'zip' => ['nullable', 'string'],
            'website' => ['nullable', 'url'],
            'facebook' => ['nullable', 'url'],
            'twitter' => ['nullable', 'url'],
            'instagram' => ['nullable', 'url'],
            'linkedin' => ['nullable', 'url'],
            'youtube' => ['nullable', 'url'],
            'tiktok' => ['nullable', 'url'],
            'payment_method' => ['nullable', 'string'],
            'payment_data' => ['nullable', 'string'],
            'affiliate_type' => ['nullable', 'string'],
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
