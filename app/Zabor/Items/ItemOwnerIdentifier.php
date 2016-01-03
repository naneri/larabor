<?php namespace App\Zabor\Items;

use Auth;

class ItemOwnerIdentifier{

	 public function checkOwnership($item_owner_id, $item_secret, $user, $code)
	 {
	 	if(!is_null($user)){
	 		if($user->pk_i_id == $item_owner_id){
	 			return true;
	 		}
	 	}
	 	if(!is_null($code)){
	 		if($code == $item_secret){
	 			return true;
	 		}
	 	}
	 	return false;
	 }
}