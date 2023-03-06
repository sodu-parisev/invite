<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\InviteSubmitRequest;
use App\Models\Invite;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Enums\Settings;

class InviteController extends Controller
{
    public function submit(InviteSubmitRequest $request)
    {
        $attributes = $request->validated();
        $attributes['token'] = Str::random(10);
        if ($request->form_of_attendance === \App\Enums\FormOfAttendance::Offline->value) {
            $attributes['passport'] = $request->file('passport')->store(Settings::PASSPORT_STORAGE_PATH->value);
            $attributes['diploma'] = $request->file('diploma')->store(Settings::DIPLOMA_STORAGE_PATH->value);
        }
        $invite = (new Invite)->fill($attributes)->save();
    }

    public function confirmation()
    {

    }
}