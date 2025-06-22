<?php

namespace Innoboxrr\AffiliateSaas\Support\Traits;

use Innoboxrr\AffiliateSaas\Support\Events\LogEvent;

trait Logger
{
    /**
     * Log a message with the model's class name.
     *
     * @param string $type
     * @return void
     */
    public function log(string $type): void
    {
        event(new LogEvent('event', $this));
    }
}