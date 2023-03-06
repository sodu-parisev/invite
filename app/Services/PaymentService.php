<?php

namespace App\Services;

use App\Enums\ClickUzSettings;
use App\Models\Invite;
use App\Models\Settings;

class PaymentService
{
    public function getPaymentUrl(Invite $invite): string
    {
        $htt_query = http_build_query([
            'service_id' => ClickUzSettings::SERVICE_ID->value,
            'merchant_id' => ClickUzSettings::MERCHANT_ID->value,
            'amount' => Settings::where('name', \App\Enums\Settings::PAYMENT_AMOUNT->value)->value('value'),
            'transaction_param' => $invite->token,
            'return_url' => url(route('invite-confirm-page')),
        ]);

        return ClickUzSettings::BASE_URL->value . '?' . $htt_query;
    }
}