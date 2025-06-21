<?php

namespace Innoboxrr\AffiliateSaas\Http\Requests\AffiliatePayout;

use Innoboxrr\AffiliateSaas\Models\AffiliatePayout;
use Innoboxrr\AffiliateSaas\Http\Resources\Models\AffiliatePayoutResource;
use Innoboxrr\AffiliateSaas\Http\Events\AffiliatePayout\Events\UpdateEvent;
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
        
        $affiliatePayout = AffiliatePayout::findOrFail($this->affiliate_payout_id);

        return $this->user()->can('update', $affiliatePayout);

    }

    public function rules()
    {
        return [
            //
            'affiliate_payout_id' => 'required|numeric'
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

        $affiliatePayout = AffiliatePayout::findOrFail($this->affiliate_payout_id);

        $affiliatePayout = $affiliatePayout->updateModel($this);

        $response = new AffiliatePayoutResource($affiliatePayout);

        event(new UpdateEvent($affiliatePayout, $this->all(), $response));

        return $response;

    }

}
