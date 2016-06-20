<?php


ini_set("display_errors", "1");
error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);

require '../config.php';
require '../Database/db_config.php';
include '../Database/db.php';
include '../lib/function.php';


	$header = getallheaders();
	
	$xmlstr = @file_get_contents('php://input');
	//var_dump(count($xmlstr) <= 0);exit;
	if (count($xmlstr) <= 0) {
	    echo 'APPERROR';
	} 
	else 
	{
		
			$userdata=  json_decode($xmlstr);
	    	$url_to_shorten = @$userdata->Url;
	    	if(strlen($url_to_shorten) >0){
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
						echo '{"result":{"status":"failure","Message":"Not a valid URL"}}'; 
					}
					
				}
				
				// check if the URL has already been shortened
				$shortened_url=is_full_url_exist($url_to_shorten);
				if(strlen($shortened_url)<=0)
				{	$shortened_url = getShortenCode();
					$data=array('full_url'=>$url_to_shorten,'shortner_url'=>$shortened_url);
					$res=add_record(DBTABLE,$data);
				}
				$data=array('result'=>array('status'=>'Success','message'=>"Shorten url genrated",'shortner_url'=>REDIRCT_HREF . $shortened_url));
				echo json_encode($data);
	    	}
	    	else{
	    		echo '{"result":{"status":"failure"}}';
	    	}
	   
	}

