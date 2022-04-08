<?php

namespace App\Http\Requests\Admin\Service;

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
            'icon'          => 'nullable|image',
            'menu_title_am' => 'required|unique:services,menu_title_am',
            'menu_title_en' => 'required|unique:services,menu_title_en',
            'menu_title_ru' => 'required|unique:services,menu_title_ru',

            'page_title_am' => 'required|unique:services,page_title_am',
            'page_title_en' => 'required|unique:services,page_title_en',
            'page_title_ru' => 'required|unique:services,page_title_ru',
        ];
    }
}
