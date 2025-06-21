<?php

namespace Innoboxrr\AffiliateSaas\Http\Requests\AffiliateConversion;

use Innoboxrr\AffiliateSaas\Models\AffiliateConversion;
use Innoboxrr\AffiliateSaas\Http\Resources\Models\AffiliateConversionResource;
use Innoboxrr\AffiliateSaas\Http\Events\AffiliateConversion\Events\CreateEvent;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        //
    }

    public function authorize()
    {

        return $this->user()->can('create', AffiliateConversion::class);

    }

    public function rules()
    {
        return [
            //
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

        $affiliateConversion = (new AffiliateConversion)->createModel($this);

        $response = new AffiliateConversionResource($affiliateConversion);

        event(new CreateEvent($affiliateConversion, $this->all(), $response));

        return $response;

    }
    
}
