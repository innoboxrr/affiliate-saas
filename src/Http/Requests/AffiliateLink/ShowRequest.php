<?php

namespace Innoboxrr\AffiliateSaas\Http\Requests\AffiliateLink;

use Innoboxrr\AffiliateSaas\Models\AffiliateLink;
use Innoboxrr\AffiliateSaas\Http\Resources\Models\AffiliateLinkResource;
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

        $affiliateLink = AffiliateLink::findOrFail($this->affiliate_link_id);

        return $this->user()->can('view', $affiliateLink);

    }

    public function rules()
    {
        return [
            'load_relations' => [
                'nullable',
                'array',
                Rule::in(AffiliateLink::$loadable_relations)
            ],
            'load_counts' => [
                'nullable',
                'array',
                Rule::in(AffiliateLink::$loadable_counts)
            ],
            'affiliate_link_id' => 'required|numeric'
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

        $affiliateLink = AffiliateLink::where('id', $this->affiliate_link_id)
            ->with($this->load_relations ?? [])
            ->withCount($this->load_counts ?? [])
            ->firstOrFail();

        return new AffiliateLinkResource($affiliateLink);

    }
    
}
