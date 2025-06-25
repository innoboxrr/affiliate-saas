<?php

namespace Innoboxrr\AffiliateSaas\Services\Affiliate\Tracking\Responders;

class ConversionResponder
{
    public static function success()
    {
        return response()->json(['success' => true, 'message' => 'Conversión registrada correctamente']);
    }

    public static function invalidAmount()
    {
        return response()->json(['error' => 'Cantidad no válida'], 400);
    }

    public static function invalidCurrency()
    {
        return response()->json(['error' => 'Moneda no válida'], 400);
    }

    public static function missingClickId()
    {
        return response()->json(['error' => 'Click ID no proporcionado'], 400);
    }

    public static function missingEventType()
    {
        return response()->json(['error' => 'Tipo de evento no proporcionado'], 400);
    }

    public static function invalidEventType()
    {
        return response()->json(['error' => 'Tipo de evento no válido'], 400);
    }

    public static function invalidClick()
    {
        return response()->json(['error' => 'Click no válido'], 404);
    }

    public static function invalidServerToken()
    {
        return response()->json(['error' => 'Invalid Token'], 403);
    }

    public static function invalidClientToken()
    {
        return response()->json(['error' => 'Invalid Token'], 403);
    }

    public static function alreadyConvertedRecently()
    {
        return response()->json(['error' => 'Ya se ha registrado una conversión recientemente'], 429);
    }

    public static function currencyDoesNotMatchProgram()
    {
        return response()->json(['error' => 'La moneda de la conversión no coincide con la del programa afiliado'], 400);
    }
}
