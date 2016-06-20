<?php

ini_set("display_errors", "1");
error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);

require 'config.php';
require 'Database/db_config.php';
include 'Database/db.php';
include 'lib/function.php';

if(remove_old_data()){
echo '15 Days old data is deleted successfullt';
}
else{
echo 'Opps! Something went wrong while deleting old data';

}
