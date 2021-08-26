<?php

namespace App\Http\Requests\AdminUser;


use Illuminate\Foundation\Http\FormRequest;

class CreateOrUpdateRequest extends FormRequest
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
     * @author
     * @return array
     */
    public function rules()
    {
        $rules = [
            'nickname' => 'required|max:255',
            'mobile' => 'required|alpha_num|max:11',
            'group_id' => 'required|alpha_num|max:11',
            'intro' => 'required|max:255',
        ];

        switch ($this->method()) {
            case 'POST':
                $rules['password'] = 'required|min:8|max:32';
                $rules['username'] = 'required|alpha_num|max:30|unique:admin_users';
                break;
            case 'PATCH':
                $rules['password'] = 'nullable|min:8|max:32';
                $rules['status'] = 'between:-1,10';
                break;
        }

        return $rules;
    }
}
