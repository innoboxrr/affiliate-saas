<?php

namespace Innoboxrr\AffiliateSaas\Services\Affiliate\Tracking;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Innoboxrr\AffiliateSaas\Services\Affiliate\Tracking\Contracts\TrackingHandlerInterface;

class TrackingService
{
    protected string $handlerNamespace = 'Innoboxrr\\AffiliateSaas\\Services\\Affiliate\\Tracking\\Handlers\\';

    public function handle(string $event, Request $request): mixed
    {
        $className = $this->handlerNamespace . Str::studly($event) . 'Handler';

        if (!class_exists($className)) {
            return response()->json(['error' => "Evento '$event' no soportado"], 400);
        }

        /** @var TrackingHandlerInterface $handler */
        $handler = app($className);

        return $handler->handle($request);
    }
}
