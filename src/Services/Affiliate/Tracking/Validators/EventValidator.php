<?php

namespace Innoboxrr\AffiliateSaas\Services\Affiliate\Tracking\Validators;

use Illuminate\Http\Request;
use Innoboxrr\AffiliateSaas\Models\AffiliateClick;
use Innoboxrr\AffiliateSaas\Services\Affiliate\Tracking\Helpers\ClientTokenValidator;
use Innoboxrr\AffiliateSaas\Services\Affiliate\Tracking\Responders\EventResponder;
use Innoboxrr\AffiliateSaas\Services\Affiliate\Tracking\Contracts\TrackingValidatorInterface;

class EventValidator implements TrackingValidatorInterface
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
            return EventResponder::missingClickId();
        }

        $this->click = AffiliateClick::where('uuid', $clickId)->first();

        if (!$this->click) {
            return EventResponder::invalidClick();
        }

        if ($this->request->input('server_conversion') && (!$token || !ServerTokenValidator::validate($token, $this->click))) {
            return EventResponder::invalidServerToken();
        }

        if ($this->request->input('client_conversion') && (!$token || !ClientTokenValidator::validate($token, $clickId))) {
            return EventResponder::invalidClientToken();
        }

        return null;
    }

    public function getValidatedEntity(): AffiliateClick
    {
        return $this->click;
    }
}
