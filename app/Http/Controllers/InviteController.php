<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\InviteSubmitRequest;
use App\Models\Invite;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Enums\Settings;
use App\Services\PaymentService;

class InviteController extends Controller
{
    public function submit(InviteSubmitRequest $request, PaymentService $paymentService)
    {
        $attributes = $request->validated();
        $attributes['token'] = Str::random(10);
        if ($request->form_of_attendance === \App\Enums\FormOfAttendance::Offline->value) {
            $attributes['passport'] = $request->file('passport')->store(Settings::PASSPORT_STORAGE_PATH->value);
            $attributes['diploma'] = $request->file('diploma')->store(Settings::DIPLOMA_STORAGE_PATH->value);
        }
        $invite = new Invite;
        $invite->fill($attributes)->save();
        return redirect($paymentService->getPaymentUrl($invite));
    }

    public function confirmPage(Invite $invite)
    {
        return view('invite-confirm', ['invite' => $invite]);
    }
}