<?php 

namespace App\Zabor\Validators;

use Validator;

class ItemValidator
{
	protected $item_rules = [
		'category_id' 	=> 'required|exists:category,pk_i_id',
		'title'			=> 'required|max:50',
		'description'	=> 'required|min:10|max:5000',
		'price'			=> 'numeric',
		'currency'		=> 'required',
		'seller-email'	=> 'required|email',
		'image_key'		=> 'required'
	];

	/**
	 * [validate description]
	 * 
	 * @param  array $item_data [description]
	 * @param  array $meta_data [description]
	 * 
	 * @return Validator           
	 */
	public function validate($item_data)
	{
		$validator = Validator::make($item_data, $this->item_rules);
		return $validator;
	}

}