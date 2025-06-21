<?php

namespace Innoboxrr\AffiliateSaas\Http\Requests\AffiliateClick;

use Innoboxrr\AffiliateSaas\Models\AffiliateClick;
use Innoboxrr\AffiliateSaas\Http\Resources\Models\AffiliateClickResource;
use Innoboxrr\AffiliateSaas\Http\Events\AffiliateClick\Events\RestoreEvent;
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
        
        $affiliateClick = AffiliateClick::withTrashed()->findOrFail($this->affiliate_click_id);
        
        return $this->user()->can('restore', $affiliateClick);

    }

    public function rules()
    {
        return [
            'affiliate_click_id' => 'required|numeric'
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

        $affiliateClick = AffiliateClick::withTrashed()->findOrFail($this->affiliate_click_id);

        $affiliateClick->restoreModel();

        $response = new AffiliateClickResource($affiliateClick);

        event(new RestoreEvent($affiliateClick, $this->all(), $response));

        return $response;

    }
    
}
