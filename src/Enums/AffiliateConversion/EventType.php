<?php

namespace Innoboxrr\AffiliateSaas\Enums\AffiliateConversion;

use Innoboxrr\Traits\EnumTrait;

enum EventType: string {

    use EnumTrait;

    case ONLINE_PURCHASE = 'online_purchase';
    case OFFLINE_PURCHASE = 'offline_purchase';
    case ONLINE_SUBSCRIPTION = 'online_subscription';
    case OFFLINE_SUBSCRIPTION = 'offline_subscription';


    public static function getLabels(): array
    {
        return [
            self::ONLINE_PURCHASE->value => __('Online Purchase'),
            self::OFFLINE_PURCHASE->value => __('Offline Purchase'),
            self::ONLINE_SUBSCRIPTION->value => __('Online Subscription'),
            self::OFFLINE_SUBSCRIPTION->value => __('Offline Subscription'),
        ];
    }

    public function label(): string
    {
        return self::getLabels()[$this->value];
    }
}