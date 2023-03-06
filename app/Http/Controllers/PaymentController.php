<?php

namespace App\Http\Controllers;

use App\Enums\Settings;
use App\Models\Invite;
use Illuminate\Http\Request;
use App\Models\ClickIncomingRequest;

class PaymentController extends Controller
{
    public function clickWebhook(Request $request)
    {
        $request->validate([
            'merchant_trans_id' => 'required|exists:invites,token'
        ]);

        $clickRequest = ClickIncomingRequest::createOrUpdate(
            [
                'merchant_trans_id' => $request->merchant_trans_id
            ],
            $request->all()
        );

        return response()->json([
            'click_trans_id' => $clickRequest->click_trans_id,
            'merchant_trans_id' => $clickRequest->merchant_trans_id,
            'merchant_prepare_id' => $clickRequest->id,
            'error' => 0,
            'error_note' => ''
        ]);
    }
}