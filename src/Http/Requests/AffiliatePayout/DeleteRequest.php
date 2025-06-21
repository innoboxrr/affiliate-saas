<?php

namespace Innoboxrr\AffiliateSaas\Http\Requests\AffiliatePayout;

use Innoboxrr\AffiliateSaas\Models\AffiliatePayout;
use Innoboxrr\AffiliateSaas\Http\Resources\Models\AffiliatePayoutResource;
use Innoboxrr\AffiliateSaas\Http\Events\AffiliatePayout\Events\DeleteEvent;
use Illuminate\Foundation\Http\FormRequest;

class DeleteRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        //
    }

    public function authorize()
    {
        
        $affiliatePayout = AffiliatePayout::findOrFail($this->affiliate_payout_id);

        return $this->user()->can('delete', $affiliatePayout);

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

        $affiliatePayout = AffiliatePayout::findOrFail($this->affiliate_payout_id);

        $affiliatePayout->deleteModel();

        $response = new AffiliatePayoutResource($affiliatePayout);

        event(new DeleteEvent($affiliatePayout, $this->all(), $response));

        return $response;

    }
    
}
