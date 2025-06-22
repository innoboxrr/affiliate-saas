<?php

namespace Innoboxrr\AffiliateSaas\Http\Requests\AffiliateProgram;

use Innoboxrr\AffiliateSaas\Models\AffiliateProgram;
use Innoboxrr\AffiliateSaas\Http\Resources\Models\AffiliateProgramResource;
use Innoboxrr\AffiliateSaas\Http\Events\AffiliateProgram\Events\UpdateEvent;
use Illuminate\Foundation\Http\FormRequest;

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
            'affiliate_program_id' => 'required|numeric|exists:affiliate_programs,id',
            'name' => 'sometimes|required|string|min:3',
            'description' => 'nullable|string|min:3',
            'test_mode' => 'required|boolean',
            'tracking_model' => 'required|string|in:first_click,last_click',
            'cookie_lifetime' => 'required|numeric|min:0',
            'default_commission' => 'nullable|numeric|min:0',
            'workspace_id' => 'required|numeric|exists:workspaces,id',
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
            'affiliate_program_id' => 'ID del programa',
            'name' => 'nombre',
            'description' => 'descripción',
            'test_mode' => 'modo de prueba',
            'tracking_model' => 'modelo de tracking',
            'cookie_lifetime' => 'vida de la cookie',
            'default_commission' => 'comisión por defecto',
            'workspace_id' => 'workspace',
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
