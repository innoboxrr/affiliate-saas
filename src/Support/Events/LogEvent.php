<?php

namespace Innoboxrr\AffiliateSaas\Support\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LogEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * The type of log event.
     *
     * @var string
     */
    public string $type;

    /**
     * The model associated with the log event.
     *
     * @var object
     */
    public object $model;

    public function __construct(string $type, object $model)
    {
        $this->type = $type;
        $this->model = $model;
    }
}
