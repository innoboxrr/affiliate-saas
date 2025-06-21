<?php

namespace Innoboxrr\AffiliateSaas\Http\Events\AffiliateClick\Events;

use Innoboxrr\AffiliateSaas\Models\AffiliateClick;
use Illuminate\Support\Facades\App;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UpdateEvent
{

    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $affiliateClick;
    public $data;
    public $response;
    public $locale;

    public function __construct(AffiliateClick $affiliateClick, array $data, $response, $locale = 'en')
    {
        $this->affiliateClick = $affiliateClick;
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