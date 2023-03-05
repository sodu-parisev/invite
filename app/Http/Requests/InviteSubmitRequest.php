<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

class InviteSubmitRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'full_name' => ['required', 'max:255'],
            'work_place' => ['required', 'max:255'],
            'phone_number' => ['required', 'max:255'],
            'email' => ['required', 'max:255'],
            'passport' => ['required', 'file', File::types(['pdf', 'png', 'jpg', 'jpeg'])],
            'diploma' => ['required', 'file', File::types(['pdf', 'png', 'jpg', 'jpeg'])],
            'form_of_attendance' => ['required', Rule::in(array_keys(\App\Enums\FormOfAttendance::getDropdownOptions()))],
        ];
    }
}
