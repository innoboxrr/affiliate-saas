<?php

namespace Innoboxrr\AffiliateSaas\Http\Events\AffiliateProgram\Events;

use Innoboxrr\AffiliateSaas\Models\AffiliateProgram;
use Illuminate\Support\Facades\App;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ForceDeleteEvent
{

    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $affiliateProgram;
    public $data;
    public $response;
    public $locale;

    public function __construct(AffiliateProgram $affiliateProgram, array $data, $response, $locale = 'en')
    {
        $this->affiliateProgram = $affiliateProgram;
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