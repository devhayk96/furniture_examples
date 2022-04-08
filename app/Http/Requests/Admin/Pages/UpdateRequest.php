<?php

namespace App\Http\Requests\Admin\Pages;

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
            'title_am' => 'required|unique:pages,title_am,'. request()->route()->page->id,
            'desc_am' => 'required',
            'title_en' => 'required|unique:pages,title_en,'. request()->route()->page->id,
            'desc_en' => 'required',
            'title_ru' => 'required|unique:pages,title_ru,'. request()->route()->page->id,
            'desc_ru' => 'required',
            'image' => 'nullable|mimes:jpg,jpeg,png',
        ];
    }
}
