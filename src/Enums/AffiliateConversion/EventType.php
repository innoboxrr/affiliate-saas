<?php

namespace Innoboxrr\AffiliateSaas\Enums\AffiliateConversion;

use Innoboxrr\Traits\EnumTrait;

enum EventType: string {

    use EnumTrait;

    case CLIENT_CONVERSION = 'client_conversion';
    case SERVER_CONVERSION = 'server_conversion';


    public static function getLabels(): array
    {
        return [
            self::CLIENT_CONVERSION->value => 'Client Conversion',
            self::SERVER_CONVERSION->value => 'Server Conversion',
        ];
    }

    public function label(): string
    {
        return self::getLabels()[$this->value];
    }
}