<?php

namespace Innoboxrr\AffiliateSaas\Http\Requests\Affiliate;

use Innoboxrr\AffiliateSaas\Models\Affiliate;
use Innoboxrr\AffiliateSaas\Http\Resources\Models\AffiliateResource;
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

        $affiliate = Affiliate::findOrFail($this->affiliate_id);

        return $this->user()->can('view', $affiliate);

    }

    public function rules()
    {
        return [
            'load_relations' => [
                'nullable',
                'array',
                Rule::in(Affiliate::$loadable_relations)
            ],
            'load_counts' => [
                'nullable',
                'array',
                Rule::in(Affiliate::$loadable_counts)
            ],
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

        $affiliate = Affiliate::where('id', $this->affiliate_id)
            ->with($this->load_relations ?? [])
            ->withCount($this->load_counts ?? [])
            ->firstOrFail();

        return new AffiliateResource($affiliate);

    }
    
}
