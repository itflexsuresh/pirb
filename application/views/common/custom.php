<?php
function currencyconvertor($currency){
	$amount 	= number_format(floor($currency*100)/100, 2,".","");
	$lastchr	= $amount[strlen($amount)-1];
	
	if($lastchr < 5){
		$amount[strlen($amount)-1] = '0';
	}else{
		$amount[strlen($amount)-1] = '5';
	}
	
	return $amount;
}
?>