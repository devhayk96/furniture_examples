<?php

namespace App\Http\Requests;

use App\Rules\EmailRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'admin.full_name' => 'required|string',
            'admin.email' => ['required', new EmailRule()],
            'admin.gender' => 'nullable|in:male,female',
            'profile.birthdate' => 'nullable|date',
            'profile.avatar' => 'nullable|mimes:jpg,jpeg,png',
            'profile.phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9',
            'profile.viber' => 'nullable|numeric|digits_between:11,15',
            'profile.whatsapp' => 'nullable|numeric|digits_between:11,15',
            'profile.telegram' => 'nullable|numeric|digits_between:11,15',
        ];
    }
}
