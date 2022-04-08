<?php

namespace App\Http\Requests\Admin\AdditionalInfo;

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
            'title_am' => 'required|unique:additional_infos,title_am,'. request()->route()->additional_info->id,
            'title_en' => 'required|unique:additional_infos,title_en,'. request()->route()->additional_info->id,
            'title_ru' => 'required|unique:additional_infos,title_ru,'. request()->route()->additional_info->id,
        ];
    }
}
