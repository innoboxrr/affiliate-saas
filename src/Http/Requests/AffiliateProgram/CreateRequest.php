<?php

namespace Innoboxrr\AffiliateSaas\Http\Requests\AffiliateProgram;

use Innoboxrr\AffiliateSaas\Models\AffiliateProgram;
use Innoboxrr\AffiliateSaas\Http\Resources\Models\AffiliateProgramResource;
use Innoboxrr\AffiliateSaas\Http\Events\AffiliateProgram\Events\CreateEvent;
use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        //
    }

    public function authorize()
    {
        return $this->user()->can('create', AffiliateProgram::class);
    }

    public function rules()
    {
        return [
            'name' => 'required|string|min:3',
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
        $affiliateProgram = (new AffiliateProgram)->createModel($this);
        $response = new AffiliateProgramResource($affiliateProgram);
        event(new CreateEvent($affiliateProgram, $this->all(), $response));
        return $response;
    }
}
