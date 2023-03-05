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
        $invite = (new Invite)->fill($request->all());
        $invite->token = Str::random(20);
        dd($request->file('passport'));
    }

    public function confirmation()
    {

    }
}