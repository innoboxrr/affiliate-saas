<?php

namespace Innoboxrr\AffiliateSaas\Http\Requests\AffiliatePayout;

use Innoboxrr\AffiliateSaas\Models\AffiliatePayout;
use Innoboxrr\AffiliateSaas\Http\Resources\Models\AffiliatePayoutResource;
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

        $affiliatePayout = AffiliatePayout::findOrFail($this->affiliate_payout_id);

        return $this->user()->can('view', $affiliatePayout);

    }

    public function rules()
    {
        return [
            'load_relations' => [
                'nullable',
                'array',
                Rule::in(AffiliatePayout::$loadable_relations)
            ],
            'load_counts' => [
                'nullable',
                'array',
                Rule::in(AffiliatePayout::$loadable_counts)
            ],
            'affiliate_payout_id' => 'required|numeric'
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

        $affiliatePayout = AffiliatePayout::where('id', $this->affiliate_payout_id)
            ->with($this->load_relations ?? [])
            ->withCount($this->load_counts ?? [])
            ->firstOrFail();

        return new AffiliatePayoutResource($affiliatePayout);

    }
    
}
