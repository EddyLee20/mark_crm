<?php


namespace App\Http\Requests\Validate;


use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'realname' => 'required|max:255',
            'mobile' => 'required|alpha_num|max:11',
            'group_id' => 'required|alpha_num|max:11',
            'remark' => 'required|max:255',
            'gender' => 'required|in:0,1',
            'is_deleted' => 'required|in:0,1',
            'status' => 'between:-1,10',
        ];
    }
}
