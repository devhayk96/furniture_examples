<?php

namespace App\Http\Requests\Admin\Role;

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
            'name' => 'required|unique:roles,name'. request()->route()->role->id,
            'name_en' => 'required|unique:roles,name_en'. request()->route()->role->id,
            'name_ru' => 'required|unique:roles,name_ru'. request()->route()->role->id,
            'permissions' => 'nullable',
            'permissions.*' => 'nullable|exists:permissions,id'
        ];
    }
}
