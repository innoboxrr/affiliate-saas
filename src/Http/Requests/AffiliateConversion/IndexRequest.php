<?php

namespace Innoboxrr\AffiliateSaas\Http\Requests\AffiliateConversion;

use Innoboxrr\AffiliateSaas\Models\AffiliateConversion;
use Innoboxrr\AffiliateSaas\Http\Resources\Models\AffiliateConversionResource;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Innoboxrr\SearchSurge\Search\Builder;

class IndexRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        //
    }

    public function authorize()
    {
        return $this->user()->can('index', AffiliateConversion::class);
    }

    public function rules()
    {
        return [
            //
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

        $builder = new Builder();

        $query = $builder->get(AffiliateConversion::class, $this->all(), config('affiliate.search-options'));

        return AffiliateConversionResource::collection($query);

    }
}
