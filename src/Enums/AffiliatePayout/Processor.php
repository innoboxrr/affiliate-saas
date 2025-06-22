<?php

namespace Innoboxrr\AffiliateSaas\Enums\AffiliatePayout;

use Innoboxrr\Traits\EnumTrait;

enum Processor: string {

    use EnumTrait;

    case MANUAL = 'manual';
    case PAYPAL = 'paypal';
    case STRIPE = 'stripe';
    case BANK_TRANSFER = 'bank_transfer';

    public static function getLabels(): array
    {
        return [
            self::MANUAL->value => __('Manual'),
            self::PAYPAL->value => __('PayPal'),
            self::STRIPE->value => __('Stripe'),
            self::BANK_TRANSFER->value => __('Bank Transfer'),
        ];
    }

    public function label(): string
    {
        return self::getLabels()[$this->value];
    }
}