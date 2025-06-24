<?php

namespace Innoboxrr\AffiliateSaas\Http\Requests\AffiliateLink;

use Innoboxrr\AffiliateSaas\Models\AffiliateLink;
use Innoboxrr\AffiliateSaas\Http\Resources\Models\AffiliateLinkResource;
use Innoboxrr\AffiliateSaas\Http\Events\AffiliateLink\Events\CreateEvent;
use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        //
    }

    public function authorize()
    {
        return $this->user()->can('create', AffiliateLink::class);
    }

    public function rules()
    {
        return [
            'name' => 'required|string|min:3',
            'code' => 'required|string|min:3',
            'target' => 'required|url',
            'affiliate_id' => 'required|numeric|exists:affiliates,id',
        ];
    }

    public function messages()
    {
        return [
            //
        ];
    }

    public function attributes()
    {
        return [
            //
        ];
    }

    protected function passedValidation()
    {
        //
    }

    public function handle()
    {
        $affiliateLink = (new AffiliateLink)->createModel($this);
        $response = new AffiliateLinkResource($affiliateLink);
        event(new CreateEvent($affiliateLink, $this->all(), $response));
        return $response;
    }
}