<?php

use Request;

function priceOrderAsc($params){
	$params['orderBy']  	= 'i_price';
	$params['orderType']	= 'ASC';

	return route('search', $params);
}

function priceOrderDesc($params){
	$params['orderBy']  	= 'i_price';
	$params['orderType']	= 'DESC';

	return route('search', $params);
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