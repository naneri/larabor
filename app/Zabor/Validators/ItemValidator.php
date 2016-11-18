<?php

namespace App\Zabor\Validators;

use Validator;

class ItemValidator
{
    protected $item_rules = [
        'category'          => 'required|exists:category,pk_i_id',
        'title'             => 'required|max:100',
        'description'       => 'required|min:5|max:5000',
        'price'             => 'numeric',
        'currency'          => 'required',
        'image_key'         => 'required'
    ];

    protected $email_rules = [
        'seller-email'  => 'required|email|unique:user,s_email',
    ];

    /**
     * [validate description]
     *
     * @param  array $item_data [description]
     * @param bool $authorized
     *
     * @return Validator
     *
     */
    public function validate($item_data, $authorized = false)
    {
        //  adding email rules for unauthorized users
        if (!$authorized) {
            $rules = array_merge($this->item_rules, $this->email_rules);
        } else {
            $rules = $this->item_rules;
        }

        // validating
        $validator = Validator::make($item_data, $rules);

        return $validator;
    }
}
