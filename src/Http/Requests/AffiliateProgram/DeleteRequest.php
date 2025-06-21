<?php

namespace Innoboxrr\AffiliateSaas\Http\Requests\AffiliateProgram;

use Innoboxrr\AffiliateSaas\Models\AffiliateProgram;
use Innoboxrr\AffiliateSaas\Http\Resources\Models\AffiliateProgramResource;
use Innoboxrr\AffiliateSaas\Http\Events\AffiliateProgram\Events\DeleteEvent;
use Illuminate\Foundation\Http\FormRequest;

class DeleteRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        //
    }

    public function authorize()
    {
        
        $affiliateProgram = AffiliateProgram::findOrFail($this->affiliate_program_id);

        return $this->user()->can('delete', $affiliateProgram);

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

        $affiliateProgram = AffiliateProgram::findOrFail($this->affiliate_program_id);

        $affiliateProgram->deleteModel();

        $response = new AffiliateProgramResource($affiliateProgram);

        event(new DeleteEvent($affiliateProgram, $this->all(), $response));

        return $response;

    }
    
}
