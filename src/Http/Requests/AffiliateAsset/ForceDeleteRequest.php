<?php

namespace Innoboxrr\AffiliateSaas\Http\Requests\AffiliateAsset;

use Innoboxrr\AffiliateSaas\Models\AffiliateAsset;
use Innoboxrr\AffiliateSaas\Http\Resources\Models\AffiliateAssetResource;
use Innoboxrr\AffiliateSaas\Http\Events\AffiliateAsset\Events\ForceDeleteEvent;
use Illuminate\Foundation\Http\FormRequest;

class ForceDeleteRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        //
    }

    public function authorize()
    {

        $affiliateAsset = AffiliateAsset::withTrashed()->findOrFail($this->affiliate_asset_id);
        
        return $this->user()->can('forceDelete', $affiliateAsset);

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

        $affiliateAsset->forceDeleteModel();

        $response = new AffiliateAssetResource($affiliateAsset);

        event(new ForceDeleteEvent($affiliateAsset, $this->all(), $response));

        return $response;

    }
    
}
