<?php 

function zbCheckError($param = null){
	if($param){
		return 'has-error';
	}
}

function zbGetMetaVal($meta_id, $meta_data){
	if(isset($meta_data[$meta_id])){
		return $meta_data[$meta_id];
	}
}

function zbGetCheckboxVal($meta_id, $meta_data){
	if(isset($meta_data[$meta_id])){
		if($meta_data[$meta_id] == 1){
			return 'checked';
		}
	}
}

function zbGetSelectVal($meta_id, $meta_data, $option){
	if(isset($meta_data[$meta_id])){
		if($meta_data[$meta_id] == $option){
			return 'selected';
		}
	}
}

function zbGetRadioVal($meta_id, $meta_data, $option){
	if(isset($meta_data[$meta_id])){
		if($meta_data[$meta_id] == $option){
			return "checked='checked'";
		}
	}
}

function zbGetTitle($item, $old){
	if(!empty($old)){
		return $old;
	}

	if(!empty($item)){
		return $item->description->s_title;
	}

	return '';
}

function zbGetDescription($item, $old){
	if(!empty($old)){
		return $old;
	}

	if(!empty($item)){
		return $item->description->s_description;
	}

	return '';
}