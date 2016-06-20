<?php

ini_set("display_errors", "1");
error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);


mysql_connect(DBURL,DBUSER,DBPWD) or die( mysql_error());
mysql_select_db(DBNAME) or die( mysql_error());
