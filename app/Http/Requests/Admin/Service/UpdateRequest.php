<?php

namespace App\Http\Requests\Admin\Service;

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
            'icon'          => 'nullable|image',
            'menu_title_am' => 'required|unique:services,menu_title_am,'. request()->route()->service->id,
            'menu_title_en' => 'required|unique:services,menu_title_en,'. request()->route()->service->id,
            'menu_title_ru' => 'required|unique:services,menu_title_ru,'. request()->route()->service->id,

            'page_title_am' => 'required|unique:services,page_title_am,'. request()->route()->service->id,
            'page_title_en' => 'required|unique:services,page_title_en,'. request()->route()->service->id,
            'page_title_ru' => 'required|unique:services,page_title_ru,'. request()->route()->service->id,
        ];
    }
}
