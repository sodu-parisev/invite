<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InviteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\App;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|

lang:
https://stackoverflow.com/questions/49061549/how-to-set-dynamic-route-prefix-in-laravel
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('invite/payment/5698b6eab6a', [PaymentController::class, 'clickWebhook'])->name('invite-payment-webhook');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/download', [DashboardController::class, 'downloadFile'])->name('dashboard.download-file');
    Route::get('/dashboard/settings', [DashboardController::class, 'settingsPage'])->name('dashboard.settings-page');
    Route::post('/dashboard/settings', [DashboardController::class, 'settingsSubmit'])->name('dashboard.settings-submit');
});

Route::post('invite', [InviteController::class, 'submit'])->name('invite-submit');
Route::get('invite/confirm', [InviteController::class, 'confirmPage'])->name('invite-confirm-page');

require __DIR__.'/auth.php';
