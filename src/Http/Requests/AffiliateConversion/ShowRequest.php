<?php

namespace Innoboxrr\AffiliateSaas\Http\Requests\AffiliateConversion;

use Innoboxrr\AffiliateSaas\Models\AffiliateConversion;
use Innoboxrr\AffiliateSaas\Http\Resources\Models\AffiliateConversionResource;
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

        $affiliateConversion = AffiliateConversion::findOrFail($this->affiliate_conversion_id);

        return $this->user()->can('view', $affiliateConversion);

    }

    public function rules()
    {
        return [
            'load_relations' => [
                'nullable',
                'array',
                Rule::in(AffiliateConversion::$loadable_relations)
            ],
            'load_counts' => [
                'nullable',
                'array',
                Rule::in(AffiliateConversion::$loadable_counts)
            ],
            'affiliate_conversion_id' => 'required|numeric'
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

        $affiliateConversion = AffiliateConversion::where('id', $this->affiliate_conversion_id)
            ->with($this->load_relations ?? [])
            ->withCount($this->load_counts ?? [])
            ->firstOrFail();

        return new AffiliateConversionResource($affiliateConversion);

    }
    
}
