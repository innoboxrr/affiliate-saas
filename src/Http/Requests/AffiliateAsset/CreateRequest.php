<?php

namespace Innoboxrr\AffiliateSaas\Http\Requests\AffiliateAsset;

use Innoboxrr\AffiliateSaas\Models\AffiliateAsset;
use Innoboxrr\AffiliateSaas\Http\Resources\Models\AffiliateAssetResource;
use Innoboxrr\AffiliateSaas\Http\Events\AffiliateAsset\Events\CreateEvent;
use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        //
    }

    public function authorize()
    {
        return $this->user()->can('create', AffiliateAsset::class);
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'min:3'],
            'type' => ['required', 'string', 'in:image,video,document,url'],
            'url' => ['nullable', 'string'],
            'usage_notes' => ['nullable', 'string'],
            'affiliate_program_id' => ['required', 'numeric', 'exists:affiliate_programs,id'],
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
        $affiliateAsset = (new AffiliateAsset)->createModel($this);
        $response = new AffiliateAssetResource($affiliateAsset);
        event(new CreateEvent($affiliateAsset, $this->all(), $response));
        return $response;
    }

}
