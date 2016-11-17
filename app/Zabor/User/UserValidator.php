<?php namespace App\Zabor\User;

use Validator;

class UserValidator
{

    protected $user_details = [
        'name'  => 'required|min:3|max:30|alpha_num',
        'phone' => 'min:9|max:45',
        'address'=> 'min:10|max:100',
        'description'=> 'min:10',
    ];

    protected $password_details = [
        'old-pass'  => 'passcheck',
        'new-pass'  => 'required|min:8',
        'new-pass-repeat'   => 'same:new-pass'
    ];

    /**
     * [validate description]
     * @param  [type] $user_data [description]
     * @return [type]            [description]
     */
    public function validate_user_details($user_data)
    {
        $validator = Validator::make($user_data, $this->user_details);

        return $validator;
    }

    /**
     * [validate_change_pass description]
     *
     * @param  [type] $pass_data [description]
     * @return [type]            [description]
     */
    public function validate_change_pass($pass_data)
    {
        $validator = Validator::make($pass_data, $this->password_details);

        return $validator;
    }
}
