<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\InviteSubmitRequest;
use App\Models\Invite;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class InviteController extends Controller
{
    public function submit(InviteSubmitRequest $request)
    {
        $attributes = $request->validated();
        dd($attributes);
        $attributes['token'] = Str::random(20);
        if ($request->form_of_attendance === \App\Enums\FormOfAttendance::Offline->value) {
            $attributes['passport'] = $request->file('passport')->store('private/passports');
            $attributes['diploma'] = $request->file('diploma')->store('private/diplomas');
        }
        $invite = (new Invite)->fill($attributes)->save();
    }

    public function confirmation()
    {

    }
}