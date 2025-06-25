<?php

namespace Innoboxrr\AffiliateSaas\Enums\AffiliateConversion;

use Innoboxrr\Traits\EnumTrait;

enum Currency: string {

    use EnumTrait;

    case USD = 'USD';
    case EUR = 'EUR';
    case MXN = 'MXN';

    public static function getLabels(): array
    {
        return [
            self::USD->value => __('US Dollar'),
            self::EUR->value => __('Euro'),
            self::MXN->value => __('Mexican Peso'),
        ];
    }

    public function label(): string
    {
        return self::getLabels()[$this->value];
    }
}