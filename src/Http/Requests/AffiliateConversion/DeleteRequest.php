<?php

namespace Innoboxrr\AffiliateSaas\Http\Requests\AffiliateConversion;

use Innoboxrr\AffiliateSaas\Models\AffiliateConversion;
use Innoboxrr\AffiliateSaas\Http\Resources\Models\AffiliateConversionResource;
use Innoboxrr\AffiliateSaas\Http\Events\AffiliateConversion\Events\DeleteEvent;
use Illuminate\Foundation\Http\FormRequest;

class DeleteRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        //
    }

    public function authorize()
    {
        
        $affiliateConversion = AffiliateConversion::findOrFail($this->affiliate_conversion_id);

        return $this->user()->can('delete', $affiliateConversion);

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

        $affiliateConversion = AffiliateConversion::findOrFail($this->affiliate_conversion_id);

        $affiliateConversion->deleteModel();

        $response = new AffiliateConversionResource($affiliateConversion);

        event(new DeleteEvent($affiliateConversion, $this->all(), $response));

        return $response;

    }
    
}
