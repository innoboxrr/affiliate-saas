<?php

namespace Innoboxrr\AffiliateSaas\Http\Requests\AffiliatePayout;

use Innoboxrr\AffiliateSaas\Models\AffiliatePayout;
use Innoboxrr\AffiliateSaas\Http\Resources\Models\AffiliatePayoutResource;
use Innoboxrr\AffiliateSaas\Http\Events\AffiliatePayout\Events\CreateEvent;
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

        return $this->user()->can('create', AffiliatePayout::class);

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

        $affiliatePayout = (new AffiliatePayout)->createModel($this);

        $response = new AffiliatePayoutResource($affiliatePayout);

        event(new CreateEvent($affiliatePayout, $this->all(), $response));

        return $response;

    }
    
}
