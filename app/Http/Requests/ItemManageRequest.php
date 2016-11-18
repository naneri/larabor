<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Zabor\Mysql\Item;

class ItemManageRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $item = Item::find($this->id);

        if($item->s_secret === $this->code){
            return true;
        }
        if($this->user()){
            if($item->fk_i_user_id == $this->user()->pk_i_id){
                return true;
            }
            return $this->user()->is_admin;
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
