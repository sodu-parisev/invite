<?php

namespace App\Http\Controllers;

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
        $request->merge(['type' => ClickUzRequestTypes::Prepare->value]);
        $clickRequest = ClickIncomingRequest::create($request->all());

        return response()->json([
            'click_trans_id' => $clickRequest->click_trans_id,
            'merchant_trans_id' => $clickRequest->merchant_trans_id,
            'merchant_prepare_id' => $clickRequest->id,
            'error' => 0,
            'error_note' => 'Success: Order exists'
        ]);
    }

    public function clickWebhookComplete(ClickUzWebhookRequest $request)
    {
        $inviteCompleted = Invite::query()
            ->where('token', $request->merchant_trans_id)
            ->whereHas('clickRequest', function (Builder $query) {
                $query->where([
                    'action' => 1,
                    'type' => ClickUzRequestTypes::Complete->value
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

        $clickRequest = ClickIncomingRequest::create(
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