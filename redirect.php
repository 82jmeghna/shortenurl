<?php
require 'config.php';
require 'Database/db_config.php';
include 'Database/db.php';

$url=strtok($_SERVER["REQUEST_URI"],'?');
$code=explode('/', $url);
$shortcode= $code[count($code) - 1];
$fullurl=get_full_url_by_code($shortcode);

header('location:'.$fullurl);
?>
