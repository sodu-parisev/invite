<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\InviteSubmitRequest;
use App\Models\Invite;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index()
    {
        $invites = Invite::query()
          ->orderBy('created_at', 'desc')
          ->paginate(15);
        return view('dashboard', ['invites' => $invites]);
    }
}