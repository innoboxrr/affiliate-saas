<?php

namespace Innoboxrr\AffiliateSaas\Services\Affiliate\Tracking\Validators;

use Illuminate\Http\Request;
use Innoboxrr\AffiliateSaas\Models\AffiliateClick;
use Innoboxrr\AffiliateSaas\Services\Affiliate\Tracking\Responders\ConversionResponder;

class ConversionValidator
{
    protected Request $request;
    protected ?AffiliateClick $click = null;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function fails(): mixed
    {
        $clickId = $this->request->input('click_id');
        $token = $this->request->input('token');

        if (!$clickId) {
            return ConversionResponder::missingClickId();
        }

        $this->click = AffiliateClick::where('uuid', $clickId)->first();
        if (!$this->click) {
            return ConversionResponder::invalidClick();
        }

        if (!$token || !ClientTokenValidator::validate($token, $clickId)) {
            return ConversionResponder::invalidToken();
        }

        if ($this->click->conversion) {
            return ConversionResponder::alreadyConverted();
        }

        return null;
    }

    public function getClick(): AffiliateClick
    {
        return $this->click;
    }
}
