<?php

namespace Innoboxrr\AffiliateSaas\Http\Requests\AffiliateProgram;

use Innoboxrr\AffiliateSaas\Models\AffiliateProgram;
use Innoboxrr\AffiliateSaas\Http\Resources\Models\AffiliateProgramResource;
use Innoboxrr\AffiliateSaas\Http\Events\AffiliateProgram\Events\ForceDeleteEvent;
use Illuminate\Foundation\Http\FormRequest;

class ForceDeleteRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        //
    }

    public function authorize()
    {

        $affiliateProgram = AffiliateProgram::withTrashed()->findOrFail($this->affiliate_program_id);
        
        return $this->user()->can('forceDelete', $affiliateProgram);

    }

    public function rules()
    {
        return [
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

        $affiliateProgram = AffiliateProgram::withTrashed()->findOrFail($this->affiliate_program_id);

        $affiliateProgram->forceDeleteModel();

        $response = new AffiliateProgramResource($affiliateProgram);

        event(new ForceDeleteEvent($affiliateProgram, $this->all(), $response));

        return $response;

    }
    
}
