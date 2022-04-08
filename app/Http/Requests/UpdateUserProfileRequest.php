<?php

namespace App\Http\Requests;

use App\Rules\EmailRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserProfileRequest extends FormRequest
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
            'full_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'email' => ['required', new EmailRule(), 'max:60'],
            'avatar_image' => 'nullable|mimes:jpg,jpeg,png',
            'phone_1' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9|max:15',
            'phone_2' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:9|max:15',
            'phone_3' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:9|max:15',
            'viber' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:9|max:15',
            'whatsapp' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:9|max:15',
            'telegram' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:9|max:15',
        ];
    }
}
