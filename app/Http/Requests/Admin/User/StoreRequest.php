<?php

namespace App\Http\Requests\Admin\User;

use App\Rules\EmailRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'user.full_name' => 'required',
            'user.email' => ['required', new EmailRule(), 'unique:users'],
            'profile.gender' => 'in:male,female',
            'profile.birthdate' => 'nullable|date',
            'avatar' => 'nullable|mimes:jpg,jpeg,png',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9',
            'profile.viber' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:9',
            'profile.whatsapp' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:9',
            'profile.telegram' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:9',
        ];
    }
}
