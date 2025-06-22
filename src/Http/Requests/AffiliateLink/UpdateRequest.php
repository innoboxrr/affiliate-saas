<?php

namespace Innoboxrr\AffiliateSaas\Http\Requests\AffiliateLink;

use Innoboxrr\AffiliateSaas\Models\AffiliateLink;
use Innoboxrr\AffiliateSaas\Http\Resources\Models\AffiliateLinkResource;
use Innoboxrr\AffiliateSaas\Http\Events\AffiliateLink\Events\UpdateEvent;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        //
    }

    public function authorize()
    {
        $affiliateLink = AffiliateLink::findOrFail($this->affiliate_link_id);

        return $this->user()->can('update', $affiliateLink);
    }

    public function rules()
    {
        return [
            'name' => 'required|string|min:3',
            'code' => 'required|string|min:3',
            'target' => 'required|url',
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
        $affiliateLink = AffiliateLink::findOrFail($this->affiliate_link_id);
        $affiliateLink = $affiliateLink->updateModel($this);
        $response = new AffiliateLinkResource($affiliateLink);
        event(new UpdateEvent($affiliateLink, $this->all(), $response));
        return $response;
    }

}
