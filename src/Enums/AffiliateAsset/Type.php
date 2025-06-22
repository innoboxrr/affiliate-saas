<?php

namespace Innoboxrr\AffiliateSaas\Enums\AffiliateAsset;

use Innoboxrr\Traits\EnumTrait;

enum Type: string {

    use EnumTrait;

    case IMAGE = 'image';
    case VIDEO = 'video';
    case PDF = 'pdf';
    case DOCUMENT = 'document';
    case URL = 'url';


    public static function getLabels(): array
    {
        return [
            self::IMAGE->value => __('Image'),
            self::VIDEO->value => __('Video'),
            self::PDF->value => __('PDF'),
        ];
    }

    public function label(): string
    {
        return self::getLabels()[$this->value];
    }
}