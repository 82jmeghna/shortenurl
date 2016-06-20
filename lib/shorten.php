<?php



ini_set('display_errors', 0);
ini_set("display_errors", "1");
error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
$url_to_shorten = get_magic_quotes_gpc() ? stripslashes(trim($_REQUEST['longurl'])) : trim($_REQUEST['longurl']);

require('../config.php');
require('../Database/db_config.php');
require('../Database/db.php');
require('function.php');
if(!empty($url_to_shorten) && preg_match('|^https?://|', $url_to_shorten))
{
	// check if the URL is valid
	if(CHECK_URL)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url_to_shorten);
		curl_setopt($ch,  CURLOPT_RETURNTRANSFER, TRUE);
		$response = curl_exec($ch);
		$response_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		if($response_status == '404')
		{
			die('Not a valid URL');
		}
		
	}
	
	// check if the URL has already been shortened
	$shortened_url=is_full_url_exist($url_to_shorten);
	if(strlen($shortened_url)<=0)
	{	$shortened_url = getShortenCode();
		$data=array('full_url'=>$url_to_shorten,'shortner_url'=>$shortened_url);
		$res=add_record(DBTABLE,$data);
	}
	echo REDIRCT_HREF . $shortened_url;
}

function getShortenedURLFromID ($integer, $base = ALLOWED_CHARS)
{
	$length = strlen($base);
	while($integer > $length - 1)
	{
		$out = $base[fmod($integer, $length)] . $out;
		$integer = floor( $integer / $length );
	}
	return $base[$integer] . $out;
}



