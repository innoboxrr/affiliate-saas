<?php

namespace Innoboxrr\AffiliateSaas\Http\Requests\AffiliateLink;

use Innoboxrr\AffiliateSaas\Models\AffiliateLink;
use Innoboxrr\AffiliateSaas\Http\Resources\Models\AffiliateLinkResource;
use Innoboxrr\AffiliateSaas\Http\Events\AffiliateLink\Events\DeleteEvent;
use Illuminate\Foundation\Http\FormRequest;

class DeleteRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        //
    }

    public function authorize()
    {
        
        $affiliateLink = AffiliateLink::findOrFail($this->affiliate_link_id);

        return $this->user()->can('delete', $affiliateLink);

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

        $affiliateLink = AffiliateLink::findOrFail($this->affiliate_link_id);

        $affiliateLink->deleteModel();

        $response = new AffiliateLinkResource($affiliateLink);

        event(new DeleteEvent($affiliateLink, $this->all(), $response));

        return $response;

    }
    
}
