<?php

namespace App\Http\Controllers;

use App\Enums\Settings;
use App\Http\Controllers\Controller;
use App\Models\Invite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use App\Models\Settings as DBSettings;

class DashboardController extends Controller
{
    public function index()
    {
        $invites = Invite::query()
          ->orderBy('created_at', 'desc')
          ->paginate(15);
        return view('dashboard', ['invites' => $invites]);
    }

    public function downloadFile(Request $request)
    {
        return Response::download(Storage::path($request->filename), basename($request->filename));
    }

    public function settingsPage()
    {
        $settings = DBSettings::all();
        return view('settings', ['settings' => $settings]);
    }

    public function settingsSubmit(Request $request)
    {
        foreach (Settings::getDbSettings() as $setting) {
            DBSettings::updateOrCreate(
              ['name' => $setting->value],
              ['value' => $request->get($setting->value)]
            );
        }
        return redirect(route('dashboard.settings-page'));
    }
}