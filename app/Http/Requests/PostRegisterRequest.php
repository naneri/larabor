<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PostRegisterRequest extends Request
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
            'username'  => 'required|alpha_num|min:3|max:30|unique:user,s_name',
            'email'     => 'required|email|unique:user,s_email',
            'password'  => 'required|min:8|confirmed',
        ];
    }
}
