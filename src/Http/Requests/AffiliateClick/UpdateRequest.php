<?php

namespace Innoboxrr\AffiliateSaas\Http\Requests\AffiliateClick;

use Innoboxrr\AffiliateSaas\Models\AffiliateClick;
use Innoboxrr\AffiliateSaas\Http\Resources\Models\AffiliateClickResource;
use Innoboxrr\AffiliateSaas\Http\Events\AffiliateClick\Events\UpdateEvent;
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
        
        $affiliateClick = AffiliateClick::findOrFail($this->affiliate_click_id);

        return $this->user()->can('update', $affiliateClick);

    }

    public function rules()
    {
        return [
            //
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

        $affiliateClick = AffiliateClick::findOrFail($this->affiliate_click_id);

        $affiliateClick = $affiliateClick->updateModel($this);

        $response = new AffiliateClickResource($affiliateClick);

        event(new UpdateEvent($affiliateClick, $this->all(), $response));

        return $response;

    }

}
