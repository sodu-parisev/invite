<?php

namespace App\Http\Controllers;

use App\Enums\PaymentStatus;
use App\Enums\Settings;
use App\Http\Controllers\Controller;
use App\Models\Invite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use App\Models\Settings as DBSettings;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\SaveSettingsRequest;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $invites = Invite::query()
            ->when($request->query() !== [], function (Builder $query) use ($request) {
                $query->where('full_name', 'like', '%' . $request->query('full_name') . '%');
            })
            ->when($request->query('show_only_paid'), function (Builder $query) {
                $query->where('payment_status', '=', PaymentStatus::Completed->value);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(15)
            ->withQueryString();
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

    public function settingsSubmit(SaveSettingsRequest $request)
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