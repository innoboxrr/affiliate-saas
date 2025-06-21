<?php

namespace Innoboxrr\AffiliateSaas\Http\Events\AffiliateConversion\Events;

use Innoboxrr\AffiliateSaas\Models\AffiliateConversion;
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

    public $affiliateConversion;
    public $data;
    public $response;
    public $locale;

    public function __construct(AffiliateConversion $affiliateConversion, array $data, $response, $locale = 'en')
    {
        $this->affiliateConversion = $affiliateConversion;
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