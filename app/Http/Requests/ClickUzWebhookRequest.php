<?php

namespace App\Http\Requests;

use App\Models\User;
use http\Env\Response;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class ClickUzWebhookRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'click_trans_id' => 'integer',
            'service_id' => 'integer',
            'click_paydoc_id' => 'integer',
            'merchant_trans_id' => 'required|exists:invites,token',
            'amount' => 'numeric',
            'action' => 'integer',
            'error' => 'integer',
            'error_note' => 'string',
            'sign_time' => 'string',
            'sign_string' => 'string',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        return response()->json([
            'something' => 'sadasd'
        ]);
    }
}
