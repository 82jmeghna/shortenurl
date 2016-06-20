<?php

ini_set("display_errors", "1");
error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
require 'config.php';
require 'Database/db_config.php';
include 'Database/db.php';
//$array=array('full_url'=>'test','shortner_url'=>'test');

//echo add_record('urls',$array);

//print_r(get_record('urls'));

?>

<!DOCTYPE html>
<html>
<title>URL shortener</title>
<meta name="robots" content="noindex, nofollow">
<head>
	<link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
	<style>
		body { font-family:Open Sans;}
		.heading1 {
            padding: 0.5% 1%;
			width: 100%;
			background: #dae7f5;
			color: #000000;
			border-bottom: 2px solid #dae7f5;
			border-radius: 4px 4px 4px 4px;
			display: inline-block;
			box-sizing: border-box;
			margin-bottom:15px;
        }

		.heading1 h2 {
			margin: 0;
			font-weight: lighter;
			font-size: 20px;
		}

        .boxcontent {
            background: none repeat scroll 0 0 #FAFAFA;
            border: 1px solid #CCC;
            margin: 0 auto;

            overflow: hidden;
            padding: 1%;
            width: 500px;
            display: table;
            border-radius: 0 0 5px 5px;
            box-shadow: 0 0 4px 0 #AAAAAA;
        }

            .boxcontent .divmain_form {
                margin-bottom: 10px;
                overflow: hidden;
                width: 100%;
            }

            .boxcontent .label_main {
                float: left;
                overflow: hidden;
                text-align: right;
                /*text-transform: uppercase;*/
                width: 25%;
                line-height: 24px;
            }

            .boxcontent .la_main {
                overflow: visible;
                float: left;
                margin-left: 1%;
                width: 14%;
                line-height: 24px;
                padding-left: 2px;
            }

			.boxcontent .la_main input {
				width:100%;
				padding: 5px;
			}
			
			.hide {display:none;}
			.show {display:block;}
			.url_label {display:block;}
	</style>
</head>
<body>
<form method="post" action="shorten.php" id="shortener">

<div style="width: 100%;">
    <div class="heading1">
        <h2 style="float: left;">
            <span>Shorten URL Application</span></h2>
    </div>
    <div class="boxcontent">
        <div class="divmain_form">
            <div class="label_main">
                <label for="longurl">URL to shorten</label> :
            </div>
            <div class="la_main" style="width: 48%;">
                <input type="text" name="longurl" id="longurl">
            </div>

            <div class="label_main">                
            </div>
            <div class="la_main" style="width: 20%;">
                <input type="submit" value="Shorten">
            </div>
        </div>
         <div class="divmain_form">
            <div id="url_shorten_div" style="display:none;">
				<label id="url_label" class="url_label">Your shorten url is </label><b><label id="lblshorten_url"></label><b>
				<br/> OR <a id="shorten_url">Click here</a>
			</div>
        </div>
    </div>
</div>
 
</form>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script>

$(function () {
	$('#shortener').submit(function () {
		$('#url_shorten_div').hide();
		$.ajax({
			data: {longurl: $('#longurl').val()},
			url: 'lib/shorten.php',
			success:function(data){
				console.log(data);
				$('#shorten_url').attr('href',data);
				$('#lblshorten_url').html(data);
				$('#url_shorten_div').show();

			},
			error:function(t,t1,t3){
				alert(t3);
			},
			complete: function (XMLHttpRequest, textStatus) {
			//$('#longurl').val(XMLHttpRequest.responseText);

		}});
		return false;
	});
});
</script>
</body>
</html>
