<?php

namespace Innoboxrr\AffiliateSaas\Http\Requests\AffiliateAsset;

use Innoboxrr\AffiliateSaas\Models\AffiliateAsset;
use Innoboxrr\AffiliateSaas\Http\Resources\Models\AffiliateAssetResource;
use Innoboxrr\AffiliateSaas\Http\Events\AffiliateAsset\Events\RestoreEvent;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RestoreRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        //
    }

    public function authorize()
    {
        
        $affiliateAsset = AffiliateAsset::withTrashed()->findOrFail($this->affiliate_asset_id);
        
        return $this->user()->can('restore', $affiliateAsset);

    }

    public function rules()
    {
        return [
            'affiliate_asset_id' => 'required|numeric'
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

        $affiliateAsset = AffiliateAsset::withTrashed()->findOrFail($this->affiliate_asset_id);

        $affiliateAsset->restoreModel();

        $response = new AffiliateAssetResource($affiliateAsset);

        event(new RestoreEvent($affiliateAsset, $this->all(), $response));

        return $response;

    }
    
}
