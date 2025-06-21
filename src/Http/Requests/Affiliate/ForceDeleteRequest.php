<?php

namespace Innoboxrr\AffiliateSaas\Http\Requests\Affiliate;

use Innoboxrr\AffiliateSaas\Models\Affiliate;
use Innoboxrr\AffiliateSaas\Http\Resources\Models\AffiliateResource;
use Innoboxrr\AffiliateSaas\Http\Events\Affiliate\Events\ForceDeleteEvent;
use Illuminate\Foundation\Http\FormRequest;

class ForceDeleteRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        //
    }

    public function authorize()
    {

        $affiliate = Affiliate::withTrashed()->findOrFail($this->affiliate_id);
        
        return $this->user()->can('forceDelete', $affiliate);

    }

    public function rules()
    {
        return [
            'affiliate_id' => 'required|numeric'
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

        $affiliate = Affiliate::withTrashed()->findOrFail($this->affiliate_id);

        $affiliate->forceDeleteModel();

        $response = new AffiliateResource($affiliate);

        event(new ForceDeleteEvent($affiliate, $this->all(), $response));

        return $response;

    }
    
}
