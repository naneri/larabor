<?php


function updatedDesc($params){
	$params['orderBy']  	= 'dt_update_date';
	$params['orderType']	= 'DESC';

	return route('search', $params);
}

function publishedDesc($params){
	$params['orderBy']  	= 'dt_pub_date';
	$params['orderType']	= 'DESC';

	return route('search', $params);
}

function priceOrderAsc($params){
	$params['orderBy']  	= 'i_price';
	$params['orderType']	= 'ASC';

	return route('search', $params);
}

function searchCategory($category_id, $params){
	$params['category'] = $category_id;

	return route('search', $params);
}

function priceOrderDesc($params){
	$params['orderBy']  	= 'i_price';
	$params['orderType']	= 'DESC';

	return route('search', $params);
}

function searchOrderName($params){
	if(!isset($params['orderBy']) && !isset($params['orderType'])){
		$params['orderBy']  	= 'dt_update_date';
		$params['orderType']	= 'DESC';
	}

	if($params['orderBy'] == 'dt_update_date' && $params['orderType']	== 'DESC'){
		return 'Активные';
	}

	if($params['orderBy'] == 'dt_pub_date' && $params['orderType']	== 'DESC'){
		return 'Новые';
	}

	if($params['orderBy'] == 'i_price' && $params['orderType']	== 'ASC'){
		return 'Подешевле';
	}
	
	if($params['orderBy'] == 'i_price' && $params['orderType']	== 'DESC'){
		return 'Подороже';
	}


}

function searchSelectedCurrency($currency, $params){
	if(isset($params['currency'])){
		if($params['currency'] == $currency->pk_c_code){
			return 'selected';
		}
	}

	return '';
}

function searchMetaSelected($meta, $option, $searchParams){

	if(isset($searchParams['meta'][$meta->pk_i_id])){
		if($searchParams['meta'][$meta->pk_i_id] == $option){
			return 'checked';
		}
	}

	return '';
}