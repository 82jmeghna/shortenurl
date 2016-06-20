<?php

/*
	Get record from database
*/
function  get_record($table=DBTABLE,$field='*'){
	if(empty($table)){
		return 'enter table name';
	}
	$sql='select '.$field.' from '.$table;
	$res=mysql_query($sql);
	$result=array();
	while($data=mysql_fetch_assoc($res)){
		foreach ($data as $key => $value) {
			$result[]=array($key=>$value);

		}
		
	}
	return $result;
}


/*
	Inser data into database
*/
function  add_record($table=DBTABLE,$insert_array=array()){
	if(empty($table)){
		return 'enter table name';
	}
	if(count($insert_array) < 0){
		return 'enter Table Field with data';
	}
	$key=array_keys($insert_array);
	$sql="Insert into ".$table." ( ". implode(',',$key).") values(";
	$datafield=array();
	foreach ($insert_array as $key => $value) {
		$datafield[]=" '".mysql_real_escape_string($value)."'";
	}
	$sql.=implode(',', $datafield);
	$sql.=')';
	//echo $sql; exit;
	mysql_query($sql);
	return mysql_insert_id();
}

/*
	Check is Short url is already exist
	Return true or false
*/

function check_if_shorten($code,$table=DBTABLE){
	if(empty($code)){
		return 'enter shorten code';
	}
	$sql="select shortner_url  from ".$table. " where shortner_url like '".$code."' limit 1";
	$res=mysql_query($sql);
	if(mysql_num_rows($res) >0){
		return true;
	}
	return false;

}

/*
	Check is full url is already exist is yes then return shortan code
*/

function is_full_url_exist($url,$table=DBTABLE){

	$sql='SELECT shortner_url FROM ' . DBTABLE. ' WHERE full_url="' . mysql_real_escape_string($url).'" limit 1' ;
	$shortened_url='';
	$res = mysql_query($sql);
	if(mysql_num_rows($res)>0)
	{
		$data=mysql_fetch_assoc($res);
		$shortened_url =$data['shortner_url'];
	}
	
	return $shortened_url;
}
/*
	Get Full Url based on Shorten Code
*/
function get_full_url_by_code($code,$table=DBTABLE){
	if(empty($code)){
		return 'enter shorten code';
	}
	$sql="select full_url  from ".$table. " where shortner_url like '".$code."' limit 1";
	$res=mysql_query($sql);
	$data=mysql_fetch_assoc($res);
	$full_url =$data['full_url'];
	return $full_url;
}


/*
	Remove old data Default is 15 Days
*/
function remove_old_data($table=DBTABLE,$days="15"){
	//delete from myTable as mytable where datediff(now(), mytable.date) > 5
	 if(mysql_query("delete from ".$table." where datediff(now(), date_created) > ".$days)){
		return true;
	 }
	 else{
		return false;
	 }
}



