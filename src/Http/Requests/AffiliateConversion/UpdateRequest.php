<?php

namespace Innoboxrr\AffiliateSaas\Http\Requests\AffiliateConversion;

use Innoboxrr\AffiliateSaas\Models\AffiliateConversion;
use Innoboxrr\AffiliateSaas\Http\Resources\Models\AffiliateConversionResource;
use Innoboxrr\AffiliateSaas\Http\Events\AffiliateConversion\Events\UpdateEvent;
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
        
        $affiliateConversion = AffiliateConversion::findOrFail($this->affiliate_conversion_id);

        return $this->user()->can('update', $affiliateConversion);

    }

    public function rules()
    {
        return [
            //
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

        $affiliateConversion = $affiliateConversion->updateModel($this);

        $response = new AffiliateConversionResource($affiliateConversion);

        event(new UpdateEvent($affiliateConversion, $this->all(), $response));

        return $response;

    }

}
