<?php
namespace PierceMoore\RubyPHP;
require_once('class.rubyphp.php');


$functions = array(
	"utility" => array(
		"exception" => array(
			"Exception Object",
			"msg"
		),
		"responds_to" => array(
			"function"
		),
		"_call" => array(
			"function"
		),
		"showObject",
		"val",
		"toJSON",
		"fromJSON",
		"serial",
		"unserial",
		"dump",
		"destroy",
		"secure" => array(
			"mode"
		),
		"md5",
		"sha1",
		"escape",
		"to_s",
		"to_f",
		"to_i",
		"to_int"
	),
	"strings" => array(
		"flip",
		"to_s",
		"length",
		"cap" => array(
			"type",
			"value = 'null'"
		)
	),
	"arrays" => array(
		"first",
		"last",
		"index" => array(
			"index"
		),
		"srt" => array(
			"method = 'sort'"
		),
		"push" => array(
			"item",
			"location"
		),
		"rotate",
		"sample" => array(
			"size = 1"
		),
		"shuf",
		"slice" => array(
			"start",
			"count",
			"end"
		),
		"uniq",
		"zip",
		"flatten"
	),
	"numbers" => array(
		"money" => array(
			"symbol = '$'",
			"decimal = '.'"
		),
		"even",
		"odd",
		"gcd" => array(
			"comparison"
		),
		"rnd" => array(
			"place"
		),
		"mult" => array(
			"times"
		),
		"av",
		"infinite",
		"NaN",
		"zero"
	),
	"ruby-specific" => array(
		"concat" => array(
			"item",
			"position = 'end'"
		),
		"prepend" => array(
			"item"
		),
		"downcase",
		"each_char" => array(
			"function"
		),
		"hex",
		"toHex",
		"index" => array(
			"key"
		),
		"match" => array(
			"regex"
		),
		"reverse",
		"swapcase",
		"each",
		"eql" => array(
			"comparison"
		)
	),
	"miscellaneous" => array(
		"tr",
		"del" => array(
			"index"
		),
		"ex" => array( // Explode
			"delimiter"
		),
		"im" => array( // Implode
			"delimiter"
		),
		"repeat" => array(
			"times"
		),
		"replace" => array(
			"regex",
			"value"
		),
		"cnt" => array(
			"recursive = 0"
		),
		"slashes" => array(
			"mode"
		),
		"pos" => array(
			"key"
		)
	)
);

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
	line-height: 100%;
}
h1,h2,h3 {
	font-size: 50px;
	margin: 0;
	padding: 0;
	clear: both;
	color: #dddddd;
	text-shadow: 0px 1px 3px #000000;
}
h2 {
	font-size: 40px;
}
h3 {
	font-size: 30px;
}
pre {
	font-size: 20px;
	line-height: 85%;
}
body {
	margin:0;
	padding: 20px;
	background: #cccccc;
}
.bigbox {
	width: 250px;
	float: left;
	clear: none;
	padding: 10px;
	box-shadow: 0px 5px 10px #000000, inset 0 1px 1px #3EC1ED;
	background: -webkit-gradient( linear , left bottom , left top, color-stop(0 , #073B5C), color-stop(1 , #0769A6));
	margin: 50px 25px auto auto;
	border-radius: 5px;
}
.container {
	width: 460px;
	min-height: 300px; 
	padding: 10px; 
	margin: 50px auto auto 10px; 
	background: #eeeeee;
	font-size: 25px;
	float:left;
	border-radius: 5px;
	box-shadow: 0px 5px 10px #000000, inset 0 1px 1px #ffffff;
}
.functions {
	padding: 10px;
	margin: auto auto 20px 20px;
	border-radius: 5px;
	font-size: 25px;
	width: 275px;
	float:left;
	color: #eeeeee;
	text-shadow:0px 1px 2px #000000;
}
.functions:hover {
	opacity: 1;
	cursor: pointer;
}
.green {
	/*border: 1px #256B12 solid;*/
	box-shadow: 0px 2px 10px #000000, inset 0px 1px 1px #CCF2B6;
	background: -webkit-gradient(linear,left bottom, left top, color-stop(0, #245904), color-stop(1, #61BA2D));
	opacity: 0.9;
}
.red {
	/*border: 1px #256B12 solid;*/
	box-shadow: 0px 2px 10px #000000, inset 0px 1px 1px #F5C4C4;
	background: -webkit-gradient(linear,left bottom, left top, color-stop(0, #961E1E), color-stop(1, #DB3B3B));
	opacity: 0.9;
}
</style>
	</head>

	<body>
		<div>
			<h1>RubyPHP Built-In Methods</h1>
	<?php

	/* *** ARRAY TEST *** 
	$data = array("Juice","Person","Place");
	$a = new r($data);
	$one = array("Me"); //,"You","I"
	$two = array("Someone","Peanuts","Baseball");
	print_r( $a->zip( $one , $two ) );
	*/

	/* *** STRING TEST ****
	$b = new r("Pierce Moore");
	print $b->secure('sha1') . '<br />';
	print $b->md5() . '<br />';
	print $b->sha1() . '<br />';
	print $b->escape() . '<br />';
	print $b->to_s() . '<br />';
	print $b->flip . '<br />';
	print $b->to_f() . '<br />';
	print $b->to_i() . '<br />';
	print $b->length . '<br />';
	print $b->cap('all') . '<br />';
	print $b->cap('none') . '<br />';
	print $b->cap('words') . '<br />';
	print $b->first() . '<br />';
	print $b->last() . '<br />';
	print $b->index(1) . '<br />';
	print $b->downcase();

	//$b->showObject();
	*/

	/* *** INTEGER TEST *****/
/*	$b = new r(1234576488);
	print $b->secure('sha1') . '<br />';
	print $b->md5() . '<br />';
	print $b->sha1() . '<br />';
	print $b->escape() . '<br />';
	print $b->to_s() . '<br />';
	print $b->flip . '<br />';
	print $b->to_f() . '<br />';
	print $b->to_i() . '<br />';
	print $b->length . '<br />';
	print $b->money() . '<br />';
	print $b->first() . '<br />';
	print $b->last() . '<br />';
	print $b->index(1) . '<br />';
	print $b->even() . '<br />';
	print $b->odd() . '<br />';
	$b->showObject();
*/
	/* *** ARRAY TEST *** */
/*	$array = array(
		"thingOne" => array(
			"'ANOTHER'" => "Yep",
			"'a'ndAnWEO 'WEDJ'er" => "YeP'Per'",
			"thASDLKJd?" => array(
				"w'O'w" => "deep 'brah' ?WOOT'WOOT'"
			)
		),
		"thingTwo" => array(
			"here we \"GOOO\"!"
		),
		"three"	=> array(
			"one" => array(
				"one" => array(
					"one" => "'This rocks'.",
					"two" => "'uh' 'huh'"
				)
			),
			"two" => array(
				"one" => array(
					"one" => "'This rocks'.",
					"two" => "'uh' 'huh'"
				)
			)
		)
	);
	$f = new r($array);
	$f->showObject();

	print_r($f->_call(function( $item ) {
		foreach( $item as $k=>$v ){
			print "Key: $k, Val: $v <br />";
		}
	}));

	//print_r($f->flatten());
	//print_r( $f );
	//print_r( $f->downcase() );
	//print $f->pos("YeP");
	//print_r($f->slashes());

*/
	// True for chaining, false for debug.
	$a = r("Pierce", true , false );
	//$a->showObject();

	/**
	 * NEW INSTANTIATION METHOD!
	 * */
	//print r("pierce",true,false)->cap("all")->val;
	
	/*
	$json = json_encode( $f->replace("u","PERSONWOOOOO") );
	print '<script type="text/javascript">console.log(' . $json . ');</script>';
	*/

	$writtenMethods = get_class_methods("PierceMoore\\RubyPHP\\r");
	$allowedMethods = $a->allowedMethods;

	// Flatten the allowedMethods array
	foreach($allowedMethods as $k=>$v) {
		print '<div class="bigbox round shadow">';
		print "<h1>$k</h1>";
		foreach($v as $key=>$val) {
			$methodsInUse[] = $val;
			print "<h3>$val</h3>";
		}
		print '</div>';
	}
	$methodsInUse = array_unique($methodsInUse);

	foreach($methodsInUse as $k=>$v) {
		foreach( $allowedMethods as $key => $val ) {
			$s = array_search( $v , $val );
			if($s) {
				$breakdown[$v][] = $key;
			}
		}
	}

	$methodCount = 0;
	$completedCount = 0;
	$output = "";

	foreach( $functions as $k=>$v ) {
		$output .= "<h2>$k</h2>";
		foreach( $v as $key=>$val ) {
			$methodCount++;
			if( is_array( $val ) ) {
				$item = $key;
			} else {
				$item = $val;
			}
			if(in_array($item, $writtenMethods)) {
				$output .= "<div class=\"functions green\">";
				$completedCount++;
			} else {
				$output .= "<div class=\"functions red\">";
			}
			if(is_array($val)) {
				$output .= $key . "(";
				if( count($val) > 1) {
					$separator = " , ";
				} else {
					$separator = " ";
				}
				foreach ($val as $value) {
					$output .= " $$value$separator";
				}
			} else {
				$output .= $val . "(";
			}
			$output .= ")";

			if( isset( $breakdown[$item] )) {
				foreach( $breakdown[$item] as $key=>$val) {
					$output .= "<br />Used by data type: $val";
				}
			}
			

			$output .= "</div>";
		}
	}


print "<h2>$completedCount / $methodCount functions written! " . round(($completedCount / $methodCount) * 100 ) . "% done!</h2>";
print $output;
	?>

			</div>
		</div>
	</body>
</html>