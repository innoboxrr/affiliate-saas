<?php

namespace Innoboxrr\AffiliateSaas\Services\Affiliate\Tracking\Validators;

use Illuminate\Http\Request;
use Innoboxrr\AffiliateSaas\Models\AffiliateClick;
use Innoboxrr\AffiliateSaas\Enums\AffiliateConversion\EventType;
use Innoboxrr\AffiliateSaas\Enums\AffiliateConversion\Currency;
use Innoboxrr\AffiliateSaas\Services\Affiliate\Tracking\Helpers\ClientTokenValidator;
use Innoboxrr\AffiliateSaas\Services\Affiliate\Tracking\Helpers\ServerTokenValidator;
use Innoboxrr\AffiliateSaas\Services\Affiliate\Tracking\Responders\ConversionResponder;
use Innoboxrr\AffiliateSaas\Services\Affiliate\Tracking\Contracts\TrackingValidatorInterface;

class ConversionValidator implements TrackingValidatorInterface
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
        $eventType = $this->request->input('event_type');
        $currency = $this->request->input('currency');
        $amount = $this->request->input('amount');

        if (!$clickId) {
            return ConversionResponder::missingClickId();
        }

        if (!$amount || !is_numeric($amount) || $amount <= 0) {
            return ConversionResponder::invalidAmount();
        }

        if (!$currency || !Currency::isValid($currency)) {
            return ConversionResponder::invalidCurrency();
        }

        if (!$eventType) {
            return ConversionResponder::missingEventType();
        }

        if (!EventType::isValid($eventType)) {
            return ConversionResponder::invalidEventType();
        }

        $this->click = AffiliateClick::with(['link.program', 'link.affiliate'])
            ->where('uuid', $clickId)
            ->first();
        if (!$this->click) {
            return ConversionResponder::invalidClick();
        }

        if ($this->request->input('server_conversion') && (!$token || !ServerTokenValidator::validate($token, $this->click))) {
            return ConversionResponder::invalidServerToken();
        }

        if ($this->request->input('client_conversion') && (!$token || !ClientTokenValidator::validate($token, $clickId))) {
            return ConversionResponder::invalidClientToken();
        }

        $lastConversion = $this->click->conversions()
            ->latest('created_at')
            ->first();
        if ($lastConversion && $lastConversion->created_at->gt(now()->subHour())) {
            return ConversionResponder::alreadyConvertedRecently();
        }

        if ($this->click->link->program->currency !== $currency) {
            return ConversionResponder::currencyDoesNotMatchProgram();
        }

        return null;
    }

    public function getValidatedEntity(): AffiliateClick
    {
        return $this->click;
    }
}
