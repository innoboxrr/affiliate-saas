<?php

namespace Innoboxrr\AffiliateSaas\Services\Affiliate\Tracking\Validators;

use Illuminate\Http\Request;
use Innoboxrr\AffiliateSaas\Models\AffiliateLink;
use Innoboxrr\AffiliateSaas\Services\Affiliate\Tracking\Responders\ClickResponder;

class ClickValidator
{
    protected Request $request;
    protected ?AffiliateLink $affiliateLink = null;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function fails(): mixed
    {
        $code = $this->request->input('code');

        if (!$code) {
            return ClickResponder::missingCode();
        }

        $this->affiliateLink = AffiliateLink::where('code', $code)->first();

        if (!$this->affiliateLink) {
            return ClickResponder::invalidLink();
        }

        return null;
    }

    public function getAffiliateLink(): AffiliateLink
    {
        return $this->affiliateLink;
    }
}
