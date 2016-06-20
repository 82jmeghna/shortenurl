<?php
function getShortenCode(){
	$seed = str_split('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()'); // and any other characters
	shuffle($seed); // probably optional since array_is randomized; this may be redundant
	$rand = substr(md5(microtime()),rand(0,26),8);
	if(check_if_shorten($rand)){
		 getShortenCode();
	}
	return $rand;
}

