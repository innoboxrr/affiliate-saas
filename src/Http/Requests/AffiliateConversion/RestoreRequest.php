<?php

namespace Innoboxrr\AffiliateSaas\Http\Requests\AffiliateConversion;

use Innoboxrr\AffiliateSaas\Models\AffiliateConversion;
use Innoboxrr\AffiliateSaas\Http\Resources\Models\AffiliateConversionResource;
use Innoboxrr\AffiliateSaas\Http\Events\AffiliateConversion\Events\RestoreEvent;
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
        
        $affiliateConversion = AffiliateConversion::withTrashed()->findOrFail($this->affiliate_conversion_id);
        
        return $this->user()->can('restore', $affiliateConversion);

    }

    public function rules()
    {
        return [
            'affiliate_conversion_id' => 'required|numeric'
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

        $affiliateConversion = AffiliateConversion::withTrashed()->findOrFail($this->affiliate_conversion_id);

        $affiliateConversion->restoreModel();

        $response = new AffiliateConversionResource($affiliateConversion);

        event(new RestoreEvent($affiliateConversion, $this->all(), $response));

        return $response;

    }
    
}
