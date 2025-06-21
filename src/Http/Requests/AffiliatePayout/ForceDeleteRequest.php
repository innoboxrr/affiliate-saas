<?php

namespace Innoboxrr\AffiliateSaas\Http\Requests\AffiliatePayout;

use Innoboxrr\AffiliateSaas\Models\AffiliatePayout;
use Innoboxrr\AffiliateSaas\Http\Resources\Models\AffiliatePayoutResource;
use Innoboxrr\AffiliateSaas\Http\Events\AffiliatePayout\Events\ForceDeleteEvent;
use Illuminate\Foundation\Http\FormRequest;

class ForceDeleteRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        //
    }

    public function authorize()
    {

        $affiliatePayout = AffiliatePayout::withTrashed()->findOrFail($this->affiliate_payout_id);
        
        return $this->user()->can('forceDelete', $affiliatePayout);

    }

    public function rules()
    {
        return [
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

        $affiliatePayout = AffiliatePayout::withTrashed()->findOrFail($this->affiliate_payout_id);

        $affiliatePayout->forceDeleteModel();

        $response = new AffiliatePayoutResource($affiliatePayout);

        event(new ForceDeleteEvent($affiliatePayout, $this->all(), $response));

        return $response;

    }
    
}
