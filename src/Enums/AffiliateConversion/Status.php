<?php

namespace Innoboxrr\AffiliateSaas\Enums\AffiliateConversion;

use Innoboxrr\Traits\EnumTrait;

enum Status: string {

    use EnumTrait;

    case PENDING = 'pending';
    case APPROVED = 'approved';
    case REJECTED = 'rejected';
    case CANCELLED = 'cancelled';
    case PENDING_PAYOUT = 'pending_payout';
    case PAID = 'paid';

    public static function getLabels(): array
    {
        return [
            self::PENDING->value => __('Pending'),
            self::APPROVED->value => __('Approved'),
            self::REJECTED->value => __('Rejected'),
            self::CANCELLED->value => __('Cancelled'),
            self::PENDING_PAYOUT->value => __('Pending Payout'),
            self::PAID->value => __('Paid'),
        ];
    }

    public function label(): string
    {
        return self::getLabels()[$this->value];
    }
}