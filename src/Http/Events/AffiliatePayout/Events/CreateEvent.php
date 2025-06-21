<?php

namespace Innoboxrr\AffiliateSaas\Http\Events\AffiliatePayout\Events;

use Innoboxrr\AffiliateSaas\Models\AffiliatePayout;
use Illuminate\Support\Facades\App;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CreateEvent
{

    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $affiliatePayout;
    public $data;
    public $response;
    public $locale;

    public function __construct(AffiliatePayout $affiliatePayout, array $data, $response, $locale = 'en')
    {
        $this->affiliatePayout = $affiliatePayout;
        $this->data = $data;
        $this->response = $response;
        $this->locale = $locale;
        App::setLocale($this->locale);
    }

    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }

}