<?php

namespace Innoboxrr\AffiliateSaas\Http\Requests\AffiliateClick;

use Innoboxrr\AffiliateSaas\Models\AffiliateClick;
use Innoboxrr\AffiliateSaas\Http\Resources\Models\AffiliateClickResource;
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

        $affiliateClick = AffiliateClick::findOrFail($this->affiliate_click_id);

        return $this->user()->can('view', $affiliateClick);

    }

    public function rules()
    {
        return [
            'load_relations' => [
                'nullable',
                'array',
                Rule::in(AffiliateClick::$loadable_relations)
            ],
            'load_counts' => [
                'nullable',
                'array',
                Rule::in(AffiliateClick::$loadable_counts)
            ],
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

        $affiliateClick = AffiliateClick::where('id', $this->affiliate_click_id)
            ->with($this->load_relations ?? [])
            ->withCount($this->load_counts ?? [])
            ->firstOrFail();

        return new AffiliateClickResource($affiliateClick);

    }
    
}
