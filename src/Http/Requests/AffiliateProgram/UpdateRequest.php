<?php

namespace Innoboxrr\AffiliateSaas\Http\Requests\AffiliateProgram;

use Innoboxrr\AffiliateSaas\Models\AffiliateProgram;
use Innoboxrr\AffiliateSaas\Http\Resources\Models\AffiliateProgramResource;
use Innoboxrr\AffiliateSaas\Http\Events\AffiliateProgram\Events\UpdateEvent;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        //
    }

    public function authorize()
    {
        
        $affiliateProgram = AffiliateProgram::findOrFail($this->affiliate_program_id);

        return $this->user()->can('update', $affiliateProgram);

    }

    public function rules()
    {
        return [
            //
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

        $affiliateProgram = AffiliateProgram::findOrFail($this->affiliate_program_id);

        $affiliateProgram = $affiliateProgram->updateModel($this);

        $response = new AffiliateProgramResource($affiliateProgram);

        event(new UpdateEvent($affiliateProgram, $this->all(), $response));

        return $response;

    }

}
