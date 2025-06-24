<?php

namespace Innoboxrr\AffiliateSaas\Services\Affiliate\Tracking\Responders;

class ClickResponder
{
    public static function missingCode()
    {
        return response()->json(['error' => 'Código no proporcionado'], 400);
    }

    public static function invalidLink()
    {
        return response()->json(['error' => 'Link no válido'], 404);
    }

    public static function success(string $clickId, string $redirectUrl)
    {
        return response()->json([
            'click_id' => $clickId,
            'redirect_url' => $redirectUrl,
        ]);
    }
}
