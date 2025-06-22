<?php

namespace Innoboxrr\AffiliateSaas\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Response;
use Innoboxrr\AffiliateSaas\Models\AffiliateLink;
use Innoboxrr\AffiliateSaas\Models\AffiliateClick;

class AffiliateTrackingController
{
    public function handle(Request $request)
    {
        $code = $request->query('code');

        if (!$code) {
            return response()->json(['error' => 'Código no proporcionado'], 400);
        }

        $link = AffiliateLink::where('code', $code)->first();

        if (!$link) {
            return response()->json(['error' => 'Link no válido'], 404);
        }

        // Generar click_id único
        $clickId = (string) Str::uuid();

        // Guardar click en la BD
        AffiliateClick::create([
            'uuid' => $clickId,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'referer' => $request->query('url', $request->headers->get('referer')),
            'url' => $link->target,
            'affiliate_link_id' => $link->id,
        ]);

        // Responder al script
        return response()->json([
            'click_id' => $clickId,
            'redirect_url' => $link->target,
        ]);
    }
}
