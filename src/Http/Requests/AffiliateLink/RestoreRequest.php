<?php

namespace Innoboxrr\AffiliateSaas\Http\Requests\AffiliateLink;

use Innoboxrr\AffiliateSaas\Models\AffiliateLink;
use Innoboxrr\AffiliateSaas\Http\Resources\Models\AffiliateLinkResource;
use Innoboxrr\AffiliateSaas\Http\Events\AffiliateLink\Events\RestoreEvent;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RestoreRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        //
    }

    public function authorize()
    {
        
        $affiliateLink = AffiliateLink::withTrashed()->findOrFail($this->affiliate_link_id);
        
        return $this->user()->can('restore', $affiliateLink);

    }

    public function rules()
    {
        return [
            'affiliate_link_id' => 'required|numeric'
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

        $affiliateLink = AffiliateLink::withTrashed()->findOrFail($this->affiliate_link_id);

        $affiliateLink->restoreModel();

        $response = new AffiliateLinkResource($affiliateLink);

        event(new RestoreEvent($affiliateLink, $this->all(), $response));

        return $response;

    }
    
}
