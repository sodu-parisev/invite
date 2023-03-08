<?php

namespace App\Http\Controllers;

use App\Enums\PaymentStatus;
use App\Enums\Settings;
use App\Models\Invite;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Models\ClickIncomingRequest;
use App\Enums\ClickUzRequestTypes;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\ClickUzWebhookRequest;

class PaymentController extends Controller
{
    public function clickWebhookPrepare(ClickUzWebhookRequest $request): JsonResponse
    {
        $invite = Invite::where('token', $request->merchant_trans_id)->first();
        $request->merge(['type' => ClickUzRequestTypes::Prepare->value]);
        $clickRequest = $invite->clickRequest()->create($request->all());
        $invite->update([
            'payment_status' => PaymentStatus::Pending->value
        ]);

        return response()->json([
            'click_trans_id' => $clickRequest->click_trans_id,
            'merchant_trans_id' => $invite->id,
            'merchant_prepare_id' => $clickRequest->id,
            'error' => 0,
            'error_note' => ''
        ]);
    }

    public function clickWebhookComplete(ClickUzWebhookRequest $request)
    {
        $inviteCompleted = Invite::query()
            ->where('token', $request->merchant_trans_id)
            ->whereHas('clickRequest', function (Builder $query) {
                $query->where([
                    'type' => ClickUzRequestTypes::Complete->value,
                    'payment_status' => PaymentStatus::Completed->value
                ]);
            })
            ->first();

        if (!empty($inviteCompleted)) {
            return response()->json([
                'click_trans_id' => $request->click_trans_id,
                'merchant_trans_id' => $request->merchant_trans_id,
                'merchant_prepare_id' => $request->id,
                'error' => -4,
                'error_note' => 'Already paid'
            ]);
        }

        $invite = Invite::where('token', $request->merchant_trans_id)->first();
        $request->merge(['type' => ClickUzRequestTypes::Complete->value]);
        $clickRequest = $invite->clickRequest()->create($request->all());
        if ($clickRequest->error != 0) {
            $invite->update([
                'payment_status' => PaymentStatus::Failed->value
            ]);
        }
        else {
            $invite->update([
                'payment_status' => PaymentStatus::Completed->value
            ]);
        }

        return response()->json([
            'click_trans_id' => $clickRequest->click_trans_id,
            'merchant_trans_id' => $clickRequest->merchant_trans_id,
            'merchant_confirm_id' => $clickRequest->id,
            'error' => 0,
            'error_note' => ''
        ]);
    }
}