<?php

namespace Innoboxrr\AffiliateSaas\Http\Requests\AffiliateAsset;

use Innoboxrr\AffiliateSaas\Models\AffiliateAsset;
use Innoboxrr\AffiliateSaas\Http\Resources\Models\AffiliateAssetResource;
use Innoboxrr\AffiliateSaas\Http\Events\AffiliateAsset\Events\UpdateEvent;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        //
    }

    public function authorize()
    {
        $affiliateAsset = AffiliateAsset::findOrFail($this->affiliate_asset_id);

        return $this->user()->can('update', $affiliateAsset);
    }

    public function rules()
    {
        return [
            'affiliate_asset_id' => ['required', 'numeric'],
            'name' => ['required', 'string', 'min:3'],
            'type' => ['required', 'string', 'in:image,video,document,url'],
            'url' => ['nullable', 'string'],
            'usage_notes' => ['nullable', 'string'],
        ];
    }

    public function messages()
    {
        return [];
    }

    public function attributes()
    {
        return [];
    }

    protected function passedValidation()
    {
        //
    }

    public function handle()
    {
        $affiliateAsset = AffiliateAsset::findOrFail($this->affiliate_asset_id);
        $affiliateAsset = $affiliateAsset->updateModel($this);
        $response = new AffiliateAssetResource($affiliateAsset);
        event(new UpdateEvent($affiliateAsset, $this->all(), $response));
        return $response;
    }

}
