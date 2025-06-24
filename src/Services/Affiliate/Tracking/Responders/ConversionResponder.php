<?php

namespace Innoboxrr\AffiliateSaas\Services\Affiliate\Tracking\Responders;

class ConversionResponder
{
    public static function success()
    {
        return response()->json(['success' => true, 'message' => 'Conversión registrada correctamente']);
    }

    public static function missingClickId()
    {
        return response()->json(['error' => 'Click ID no proporcionado'], 400);
    }

    public static function invalidClick()
    {
        return response()->json(['error' => 'Click no válido'], 404);
    }

    public static function invalidToken()
    {
        return response()->json(['error' => 'Token inválido o manipulado'], 403);
    }

    public static function alreadyConverted()
    {
        return response()->json(['error' => 'Conversión ya registrada'], 409);
    }
}
