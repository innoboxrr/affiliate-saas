<?php

namespace Innoboxrr\AffiliateSaas\Http\Controllers;

use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class AffiliateScriptController
{
    public function serve(): BinaryFileResponse
    {
        $path = (request()->query('test') === 'true') ?
            __DIR__ . '/../../../resources/js/aff-client.js' :
            __DIR__ . '/../../../resources/js/aff-client.min.js';

        try {
            return response()->file($path, [
                'Content-Type' => 'application/javascript',
                'Cache-Control' => 'public, max-age=86400',
            ]);
        } catch (FileNotFoundException $e) {
            abort(404, 'Script no encontrado');
        }
    }
}
