<?php

namespace Innoboxrr\AffiliateSaas\Http\Requests\AffiliateProgram;

use Innoboxrr\AffiliateSaas\Models\AffiliateProgram;
use Innoboxrr\AffiliateSaas\Http\Resources\Models\AffiliateProgramResource;
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

        $affiliateProgram = AffiliateProgram::findOrFail($this->affiliate_program_id);

        return $this->user()->can('view', $affiliateProgram);

    }

    public function rules()
    {
        return [
            'load_relations' => [
                'nullable',
                'array',
                Rule::in(AffiliateProgram::$loadable_relations)
            ],
            'load_counts' => [
                'nullable',
                'array',
                Rule::in(AffiliateProgram::$loadable_counts)
            ],
            'affiliate_program_id' => 'required|numeric'
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

        $affiliateProgram = AffiliateProgram::where('id', $this->affiliate_program_id)
            ->with($this->load_relations ?? [])
            ->withCount($this->load_counts ?? [])
            ->firstOrFail();

        return new AffiliateProgramResource($affiliateProgram);

    }
    
}
