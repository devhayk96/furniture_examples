<?php

namespace App\Http\Requests\Admin\Admin;

use App\Rules\EmailRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
        $id = $this->request->all()['id'];
        return [
            'admin.full_name' => 'required|string',
            'admin.email' => ['required', new EmailRule(), 'unique:admins,email,'.$id],
            'role' => 'required|numeric',
            'profile.gender' => 'in:male,female',
            'profile.birthdate' => 'nullable|date',
            'avatar' => 'nullable|mimes:jpg,jpeg,png',
            'profile.phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
            'profile.viber' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/',
            'profile.whatsapp' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/',
            'profile.telegram' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/',
        ];
    }

    public function messages()
    {
        return [
            'profile.phone.regex' => __('main.invalid_phone'),
            'profile.viber.regex' => __('main.invalid_phone'),
            'profile.whatsapp.regex' => __('main.invalid_phone'),
            'profile.telegram.regex' => __('main.invalid_phone'),
        ];
    }
}
