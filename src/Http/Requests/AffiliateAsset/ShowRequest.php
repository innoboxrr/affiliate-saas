<?php

namespace Innoboxrr\AffiliateSaas\Http\Requests\AffiliateAsset;

use Innoboxrr\AffiliateSaas\Models\AffiliateAsset;
use Innoboxrr\AffiliateSaas\Http\Resources\Models\AffiliateAssetResource;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ShowRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        //
    }

    public function authorize()
    {

        $affiliateAsset = AffiliateAsset::findOrFail($this->affiliate_asset_id);

        return $this->user()->can('view', $affiliateAsset);

    }

    public function rules()
    {
        return [
            'load_relations' => [
                'nullable',
                'array',
                Rule::in(AffiliateAsset::$loadable_relations)
            ],
            'load_counts' => [
                'nullable',
                'array',
                Rule::in(AffiliateAsset::$loadable_counts)
            ],
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

        $affiliateAsset = AffiliateAsset::where('id', $this->affiliate_asset_id)
            ->with($this->load_relations ?? [])
            ->withCount($this->load_counts ?? [])
            ->firstOrFail();

        return new AffiliateAssetResource($affiliateAsset);

    }
    
}
