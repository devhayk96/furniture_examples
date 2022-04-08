<?php

namespace App\Http\Requests\Admin\WebsiteInfo;

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
        return [
            'email' => ['required', new EmailRule(), 'max:60'],
            'address_am' => 'required|string|max:255',
            'address_en' => 'required|string|max:255',
            'address_ru' => 'required|string|max:255',
            'phone_number' => 'required|max:255',
            'office_phone_number' => 'required|max:255',
            'footer_links.*.title_am' => 'required|max:255',
            'footer_links.*.title_en' => 'required|max:255',
            'footer_links.*.title_ru' => 'required|max:255',
            'photo_service.title_am' => 'required|max:255',
            'photo_service.title_en' => 'required|max:255',
            'photo_service.title_ru' => 'required|max:255',
            'photo_service.desc_am' => 'required|string',
            'photo_service.desc_en' => 'required|string',
            'photo_service.desc_ru' => 'required|string',
            'image' => 'nullable|mimes:jpg,jpeg,png',
        ];
    }
}
