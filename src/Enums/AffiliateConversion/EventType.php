<?php

namespace Innoboxrr\AffiliateSaas\Enums\AffiliateConversion;

use Innoboxrr\Traits\EnumTrait;

enum EventType: string {

    use EnumTrait;

    case CLIENT_CONVERSION = 'client_conversion';
    case SERVER_CONVERSION = 'server_conversion';
    case AFFILIATE_REFERER_FEE = 'affiliate_referer_fee';


    public static function getLabels(): array
    {
        return [
            self::CLIENT_CONVERSION->value => 'Client Conversion',
            self::SERVER_CONVERSION->value => 'Server Conversion',
            self::AFFILIATE_REFERER_FEE->value => 'Affiliate Referer Fee',
        ];
    }

    public function label(): string
    {
        return self::getLabels()[$this->value];
    }
}