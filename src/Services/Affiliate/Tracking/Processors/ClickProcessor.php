<?php

namespace Innoboxrr\AffiliateSaas\Services\Affiliate\Tracking\Processors;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Innoboxrr\AffiliateSaas\Models\AffiliateLink;
use Innoboxrr\AffiliateSaas\Models\AffiliateClick;

class ClickProcessor
{
    protected AffiliateLink $link;
    protected Request $request;

    public function __construct(AffiliateLink $link, Request $request)
    {
        $this->link = $link;
        $this->request = $request;
    }

    public function process(): string
    {
        $clickId = (string) Str::uuid();

        AffiliateClick::create([
            'uuid' => $clickId,
            'ip_address' => $this->request->ip(),
            'user_agent' => $this->request->userAgent(),
            'referer' => $this->request->input('url', $this->request->headers->get('referer')),
            'url' => $this->link->target,
            'affiliate_link_id' => $this->link->id,
        ]);

        return $clickId;
    }
}
