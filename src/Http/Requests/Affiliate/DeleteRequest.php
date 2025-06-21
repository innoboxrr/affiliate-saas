<?php

namespace Innoboxrr\AffiliateSaas\Http\Requests\Affiliate;

use Innoboxrr\AffiliateSaas\Models\Affiliate;
use Innoboxrr\AffiliateSaas\Http\Resources\Models\AffiliateResource;
use Innoboxrr\AffiliateSaas\Http\Events\Affiliate\Events\DeleteEvent;
use Illuminate\Foundation\Http\FormRequest;

class DeleteRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        //
    }

    public function authorize()
    {
        
        $affiliate = Affiliate::findOrFail($this->affiliate_id);

        return $this->user()->can('delete', $affiliate);

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

        $affiliate = Affiliate::findOrFail($this->affiliate_id);

        $affiliate->deleteModel();

        $response = new AffiliateResource($affiliate);

        event(new DeleteEvent($affiliate, $this->all(), $response));

        return $response;

    }
    
}
