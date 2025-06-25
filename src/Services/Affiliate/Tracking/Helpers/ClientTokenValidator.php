<?php

namespace Innoboxrr\AffiliateSaas\Services\Affiliate\Tracking\Helpers;

class ClientTokenValidator
{
    public static function validate(string $token, string $clickId): bool
    {
        $parts = explode('.', $token);

        if (count($parts) !== 4) {
            return false;
        }

        [$cid, $timestamp, $salt, $hash] = $parts;

        if ($cid !== $clickId) {
            return false;
        }

        $maxAgeSeconds = 7200;
        $now = now()->timestamp * 1000;
        if (abs($now - (int) $timestamp) > $maxAgeSeconds * 1000) {
            return false;
        }

        $base = "{$clickId}:{$timestamp}:{$salt}";
        $expectedHash = base_convert(abs(crc32($base)), 10, 36);

        return $hash === $expectedHash;
    }
}