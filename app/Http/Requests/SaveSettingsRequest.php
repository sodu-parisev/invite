<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Enums\Settings;

class SaveSettingsRequest extends FormRequest
{
    public function rules(): array
    {
        $rules = [];
        foreach (Settings::getDbSettings() as $setting) {
            $rules[$setting->value] = ['string'];
        }
        return $rules;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            Settings::PAYMENT_AMOUNT->value => preg_replace('/\D/', '', $this->{Settings::PAYMENT_AMOUNT->value})
        ]);
    }
}
