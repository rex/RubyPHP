<?php

/**
 * 
 * HERE. Let's make a map of the functions that I want to write for this class.
 * 
 * 
 * *** NUMBERS ***
 * isMoney()
 * even()
 * odd()
 * gcd() <-- Greatest common denominator
 * int() <-- Is an integer?
 * round( $places )
 * multiply( $times );
 * abs()
 * infinite()
 * NaN()
 * zero()
 * round()
 * 
 * *** ARRAYS ***
 * first()
 * last()
 * index( $num )
 * sort()
 * push()
 * rotate()
 * sample()
 * select()
 * shuffle()
 * slice()
 * uniq()
 * zip()
 * 
 * 
 * *** MISCELLANEOUS ***
 * 
 * toJSON()
 * fromJSON()
 * serialize()
 * unserialize()
 * dump() <- Will replace var_dump( $foo )
 * destroy()
 * secure() <-- Will generate sha1 hash WITH SALT
 * md5()
 * sha1()
 * trim()
 * delete()
 * explode( $delim ) <-- Usable on objects, arrays, and strings
 * implode( $delim = null ) <-- Same as explode(). Optional $delim if they want to separate by a character
 * repeat( $times )
 * replace( $needle , $replace )
 * shuffle() <-- Shuffles a string, array, or number
 * count() <-- Counts the number of entities in an object, array, string, or number
 * comp( $comparison ) <-- Compares the string to the comparison string provided
 * slashes( $function ) <-- Add/Strip slashes. Accepts "add" , "strip"
 * pos( $needle ) <-- Searches for $needle in the "haystack" and returns the numeric position of said needle.
 * escape()
 * to_f() <-- Like to_s() but creates a float
 * to_i() / to_int() <-- Like to_f() but creates an int
 * 
 * 
 * *** Ruby-Specific Functions ***
 * concat( $item ) <-- Appends a string to the object. Works for Strings and arrays.
 * prepend( $item ) <-- Same as concat() except for in front of string
 * downcase() <-- See capitalize() function
 * each_char() 
 * hex()
 * index( $needle ) <-- see pos() above
 * match()
 * succ() <-- Increments a value. Applicable to strings, numbers
 * reverse() 
 * swapcase()
 * each()
 * hash()
 * eql()
 **/

$functions = array(
	"utility" => array(
		"exception" => array(
			"Exception Object",
			"msg"
		),
		"responds_to" => array(
			"function"
		),
		"showObject",
		"val",
		"toJSON",
		"fromJSON",
		"serialize",
		"unserialize",
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
		"capitalize" => array(
			"type"
		)
	),
	"arrays" => array(
		"first",
		"last",
		"index" => array(
			"index"
		),
		"sort" => array(
			"key",
			"type"
		),
		"push" => array(
			"item",
			"location"
		),
		"rotate",
		"sample",
		"select" => array(
			"index"
		),
		"shuffle",
		"slice" => array(
			"start",
			"count",
			"end"
		),
		"uniq",
		"zip"
	),
	"numbers" => array(
		"isMoney" => array(
			"symbol = '$'",
			"decimal = '.'"
		),
		"even",
		"odd",
		"gcd" => array(
			"comparison"
		),
		"int",
		"round" => array(
			"place"
		),
		"multiply" => array(
			"times"
		),
		"abs",
		"infinite",
		"NaN",
		"zero"
	),
	"ruby-specific" => array(
		"concat" => array(
			"value",
			"position = end"
		),
		"prepend" => array(
			"value"
		),
		"downcase",
		"each_char" => array(
			"function"
		),
		"hex",
		"index" => array(
			"key"
		),
		"match" => array(
			"regex"
		),
		"succ",
		"reverse",
		"swapcase",
		"each",
		"hash" => array(
			"mode"
		),
		"eql" => array(
			"comparison"
		)
	),
	"miscellaneous" => array(
		"trim",
		"delete" => array(
			"index"
		),
		"explode" => array(
			"delimiter"
		),
		"implode" => array(
			"delimiter"
		),
		"repeat" => array(
			"times"
		),
		"replace" => array(
			"regex",
			"value"
		),
		"shuffle",
		"count" => array(
			"recursive = 0"
		),
		"comp" => array(
			"comparison"
		),
		"slashes" => array(
			"mode"
		),
		"pos" => array(
			"key"
		)
	)
);

/**
 * I would call this class RubyPHP, but in an effort to make development with this class more efficient, I figured writing $foo = new RubyPHP("$string") a thousand times wasn't worth it.
 * 
 * @package RubyPHP
 * @author Pierce Moore
 * @version 0.1
 * @copyright Pierce Moore 2012 , Refreshed Web Design 2012
 */
class r {

	/**
	* First we declare all our publicly accessible variables for each data type. These will be accessible by $foo->$var. 
	* 
	* ex:
	* $foo = new r("$string");
	* print $foo->length;
	* print $foo->even;
	* print $foo-slashes;
	* 
	* etc..
	* */

	var $to_s;
	var $to_f;
	var $to_i;
	var $to_int;
	var $length;
	var $capitalize;
	var $count;
	var $isMoney;
	var $even;
	var $odd;
	var $reverse;
	var $md5;
	var $sha1;
	var $val;
	var $trim;
	var $slashes;
	var $flipArray;

	function __construct( $item ) {

		$this->self = $item;
		$this->value = $item;
		$this->val = $this->value;
		$this->origVal = $this->value;
		$this->buildObject();

		$this->showObject();
	}

	/**
	 * Just a plain utility function to deal with errors. 
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * @param string $function - The function that threw the exception
	 * @param string $msg - The message that was thrown
	 * @return void
	 * */
	public final function exception( Exception $e , $msg ) {

		print "#######################################";

		print "Exception: $msg \n";

		print "Stack Trace is as follows: \n <pre>";

		print_r( $e->getTrace() );

		print "#######################################";

	}

/******************************************************
 * 
 * 			UTILITY FUNCTIONS
 * 
 * ****************************************************/
	/**
	 * Just a plain utility function to deal with errors. 
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * @param string $function - The function that threw the exception
	 * @param string $msg - The message that was thrown
	 * @return void
	 * */
	public final function responds_to( $function ) {

		return in_array( $function , $this->methods );
	}

	/**
	 * Just a simple utility function to display the formatted object.
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * 
	 * @return void
	 * */
	public final function showObject() {

		print "<pre>";
		print_r( $this );
		print "</pre>";

	}

	/**
	 * This is the function that is called upon instantiation. It builds the corresponding object for the item provided and gives it the properties and functionality of a ruby object.
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * @return void
	 **/
	private final function buildObject() {

		try {

			$s = $this->self;

			$this->type = gettype( $s );

			switch( $this->type ) {

				case "boolean":
					$this->buildBoolean();
					break;
				case "string":	
					$this->buildString();
					break;
				case "integer":
					$this->buildInteger();
					break;
				case "double":
					$this->buildDouble();
					break;
				case "array":
					$this->buildArray();
					break;
				// If it is an object, empty or null type or is otherwise not on this list, we spit it back out. OOPSIES
				case "object":
				case null:
				default: 
					throw new exception("Invalid argument or item supplied to RubyPHP. Please try again.");
					break;
			}	
		} catch( Exception $e ) {

			$this->exception( $e , $e->getMessage() );

		}
	}

	/**
	 * With every object instantiation, let's build the basic data that will be present for every single type of value.
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * 
	 * @return void
	 **/
	private final function runMethods() {

		foreach( $this->methods as $k ) {
			//$this->$k = $this->$k();
		}

	}

	/**
	 * Let's go down the list, doing the easy stuff first.
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * 
	 * @return boolean
	 **/
	private final function buildBoolean() {

		$this->value = ( $this->self ) ? 1 : 0;
		$this->valueString = ( $this->value ) ? "true" : "false";
		$this->methods = array("flip","to_s","length");
		$this->runMethods();
		return $this->value;
	}

	/**
	 * Still going. Now we're building the "string" object.
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * 
	 * @return boolean
	 * */
	private final function buildString() {

		$this->valueString = $this->value;
		$this->length = strlen( $this->value );
		$this->chars = str_split( $this->value );
		$this->flip = $this->flip();
		$this->methods = array("flip","to_s","length","capitalize","lowercase","capFirst");
		$this->runMethods();
		return $this->value;

	}

	/**
	 * Still going. Now we're building the "integer" object.
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * 
	 * @return boolean
	 * */
	private final function buildInteger() {

		$this->valueString = $this->to_s($this->value);
		$this->length = strlen( $this->value );
		$this->chars = str_split((string)$this->value);
		$this->methods = array("isMoney","even","odd","gcd","int","round","multiply","abs","infinite","NaN","zero");
		$this->runMethods();
		return $this->value;
	}

	/**
	 * Still going. Now we're building the "double" object.
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * 
	 * @return boolean
	 * */
	private final function buildDouble() {

		$this->valueString = $this->to_s();
		$this->to_s = $this->to_s();
		$this->length = $this->length();
		$this->runMethods();
		return $this->value;

	}

	/**
	 * Still going. Now we're building the "array" object.
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * 
	 * @return boolean
	 * */
	private final function buildArray() {

		$this->valueString = null;
		$this->length = $this->length();
		$this->flip = $this->flip();
		$this->methods = array("first","last","index","sort","push","rotate","sample","select","shuffle","slice","uniq","zip");
		$this->runMethods();
		return $this->value;
	}

	/**
	 * Simple val() function, returns the value of the object. 
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * 
	 * @return mixed
	 **/
	public final function val() {

		return $this->value;

	}

	/**
	 * Returns the REVERSE of the object. If it's a boolean, it will act like an on/off switch. For arrays, strings, and numbers it will just reverse the order of the characters. 
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * 
	 * @return mixed
	 **/
	public final function flip() {

		try {

			switch( $this->type ) {

				case "boolean":
					return !$this->value;
					break;
				case "string":
					for( $i = ( count( $this->chars ) - 1) ; $i >= 0 ; $i-- ) {
						$data[] = $this->chars[$i];
					}
					$this->flipArray = $data;
					return implode($data);
					break;
				case "array":
					$this->flipArray = array_reverse( $this->value );
					return $this->flipArray;
					break;
				default:
					return null;
			}
		} catch( Exception $e ) {
			$this->exception( $e , $e->getMessage() );
		}

	}

	/**
	 * Returns the stringified version of the object's value. 
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * 
	 * @return string
	 **/
	public final function to_s() {

		return (string)$this->value;

	}

	/**
	 * Returns the integer version of the object's value. 
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * 
	 * @return int
	 **/
	public final function to_i() {

		return (int)$this->value;

	}

	/**
	 * Returns the integer version of the object's value. ## DIFFERENT SYNTAX ##
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * 
	 * @return int
	 **/
	public final function to_int() {

		return (int)$this->value;

	}

	/**
	 * Returns the floating point decimal version of the object's value.
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * 
	 * @return float
	 **/
	public final function to_f() {

		return (float)$this->value;

	}

	/**
	 * Simply returns the length of the value. If it's a number or string, it will return the number of characters. If an array or object, it will return the number of elements present. 
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * 
	 * @return int
	 **/
	public final function length( $mode = COUNT_NORMAL ) {

		if( !is_array( $this->value )) {

			return strlen( (string)$this->value );

		} else if (is_array( $this->value )) {

			return count( $this->value , $mode );
		}

	}

	/**
	 * Deals with casing in strings. Is used to modify the upper- and lower-case nature of the string. 
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * 
	 * @param string $type - The parameters that the capitalize function must work within. Accepts: "first" , "all" , "none" , "words"
	 * @return string
	 **/
	public final function capitalize( $type ) {

		try {

			switch( $type ) {

				case "first":
					return ucfirst( strtolower( $this->value ));
					break;
				case "all":
					return strtoupper( $this->value );
					break;
				case "none":
					return strtolower( $this->value );
					break;
				case "words":
					return ucwords( strtolower( $this->value ));
					break;
				default: 
					throw new exception("Invalid capitalization mode supplied. 'first', 'all', 'none', and 'words' are acceptable.");
			}

		} catch( Exception $e ) {

			$this->exception( $e , $e->getMessage() );

		}

	}

	/**
	 * Returns the first item in an array
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * 
	 * @return mixed
	 **/
	public final function first() {

		// PLACEHOLDER BRAHHHHHH

	}

}


?>