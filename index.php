<?php

require_once('class.rubyphp.php');


?>
<html>
	<head>

<style type="text/css">
@font-face {
	font-family: League;
	src: url('league.otf');
}
* {
	font-family: League;
}
h1,h2 {
	font-size: 50px;
	margin: 0;
	padding: 0;
}
h2 {
	font-size: 40px;
}
pre {
	font-size: 20px;
	line-height: 85%;
}
body {
	margin:0;
	padding: 0;
	background: #cccccc;
}
.bigbox {
	width: 1000px;
	margin: 50px auto auto auto;
}
.container {
	width: 460px;
	min-height: 300px; 
	padding: 10px; 
	margin: 50px auto auto 10px; 
	border: 1px #999999 solid; 
	background: #eeeeee;
	font-size: 25px;
	float:left;
}
.functions {
	padding: 10px;
	margin: auto auto 10px auto;
	border-radius: 5px;
	box-shadow: 0px 2px 10px #000000;
	font-size: 25px;
	color: #eeeeee;
	text-shadow:0px 1px 2px #000000;
}
.green {
	/*border: 1px #256B12 solid;*/
	box-shadow: 0px 2px 5px #000000, inset 0px 1px 1px #CCF2B6;
	background: -webkit-gradient(linear,left bottom, left top, color-stop(0, #245904), color-stop(1, #61BA2D));
}
.red {
	/*border: 1px #256B12 solid;*/
	box-shadow: 0px 2px 5px #000000, inset 0px 1px 1px #F5C4C4;
	background: -webkit-gradient(linear,left bottom, left top, color-stop(0, #961E1E), color-stop(1, #DB3B3B));
}
</style>
	</head>

	<body>

		<div class="bigbox">
			<div class="container">
	<?php

	/**/
	$a = new r(true);
	$b = new r("Pierce");
	//print_r($b->chars);
	//$secure = $b->md5();
	// laksjdlkj1290odnlokjslakdj012in
	// 1234.50
	//$c->isMoney();
	$c = new r(1234);
	//$c->isMoney();
	$d = new r(12.34);
	$array = array(
		"thingOne" => array(
			"another" => "Yep",
			"andAnother" => "Yepper",
			"third?" => array(
				"wow" => "deep brah"
			)
		),
		"thingTwo" => array(
			"here we go!"
		)
	);
	$f = new r($array);
	//print $r->flip();


	?>
			</div>

			<div class="container">
				<h1>RubyPHP Built-In Methods</h1>
	<?php

	$methodList = get_class_methods("r");

	/*
	print "<pre>";
	print_r($methodList);
	print "</pre>";
	*/

	foreach( $functions as $k=>$v ) {
		print "<h2>$k</h2>";
		foreach( $v as $key=>$val ) {

			if( is_array( $val ) ) {
				if(in_array($key, $methodList)) {
					print "<div class=\"functions green\">";
				} else {
					print "<div class=\"functions red\">";
				}
			} else {
				if(in_array($val, $methodList)) {
					print "<div class=\"functions green\">";
				} else {
					print "<div class=\"functions red\">";
				}
			}
			if(is_array($val)) {
				print $key . "(";
				if( count($val) > 1) {
					$separator = " , ";
				} else {
					$separator = " ";
				}
				foreach ($val as $value) {
					print " $$value$separator";
				}
			} else {
				print $val . "(";
			}
			print ")</div>";
		}
	}
	 

	?>

			</div>
		</div>
	</body>
</html>