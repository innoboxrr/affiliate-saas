<?php

namespace Innoboxrr\AffiliateSaas\Http\Requests\AffiliateAsset;

use Innoboxrr\AffiliateSaas\Models\AffiliateAsset;
use Innoboxrr\AffiliateSaas\Http\Resources\Models\AffiliateAssetResource;
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
        return $this->user()->can('index', AffiliateAsset::class);
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

        $query = $builder->get(AffiliateAsset::class, $this->all(), config('affiliate.search-options'));

        return AffiliateAssetResource::collection($query);

    }
}
