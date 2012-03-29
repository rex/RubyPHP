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

	var $allowedMethods = array(
		"boolean" => array(
			"val",
			"flip",
			"to_s",
			"length"
		),
		"string" => array(
			"val",
			"flip",
			"to_s",
			"length",
			"cap",
			"lowercase",
			"capFirst",
			"toJSON",
			"fromJSON",
			"dump",
			"secure",
			"sha1",
			"md5",
			"escape",
			"to_int",
			"to_i",
			"to_f",
			"first",
			"last",
			"index",
			"sort",
			"push",
			"sample",
			"rotate",
			"select",
			"shuffle",
			"slice"
		),
		"integer" => array(
			"val",
			"money",
			"even",
			"odd",
			"gcd",
			"rnd",
			"mult",
			"av",
			"infinite",
			"NaN",
			"zero"
		),
		"double" => array(
			"val",
			"money",
			"even",
			"odd",
			"gcd",
			"rnd",
			"mult",
			"av",
			"infinite",
			"NaN",
			"zero"
		),
		"array" => array(
			"val",
			"first",
			"last",
			"index",
			"sort",
			"push",
			"rotate",
			"sample",
			"select",
			"shuffle",
			"slice",
			"uniq",
			"zip"
		)
	);

	function __construct( $item ) {

		$this->self = $item;
		$this->value = $item;
		$this->val = $this->value;
		$this->origVal = $this->value;
		$this->buildObject();

		//$this->showObject();
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
		$this->methods = $this->allowedMethods['boolean'];
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
		$this->methods = $this->allowedMethods["string"];
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
		$this->flip = $this->flip();
		$this->methods = $this->allowedMethods['integer'];
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
		$this->methods = $this->allowedMethods['double'];
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
		$this->methods = $this->allowedMethods['array'];
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
	 * Dumps the contents of the object 
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * 
	 * @return mixed
	 **/
	public final function dump() {

		var_dump( $this->value );

	}

	/**
	 * Destroys an object 
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * 
	 * @return void
	 **/
	public final function destroy() {

		foreach( $this as $k ){
			$k = "";
		}

	}

	/**
	 * Secures an object 
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * 
	 * @param string $mode - The hashing method to use. Accepts "md5" or "sha1"
	 * @param string $salt - The salt to use on the item prior to it being hashed. Default: null (no salt)
	 * @param string $position - The position to place the salt. Accepts "first" or "last". Default: Null (no salt position)
	 * @return string
	 **/
	public final function secure( $mode = "sha1" , $salt = null , $position = null ) {

		try {
			if( is_array($this->value)) {
				throw new exception("Arrays are not allowed to be secured. Please try again.");
			}
			$string = $this->value;
			if( $salt != null ) {
				if( strcmp( $position , "first" ) == 0 ) {
					$string = $salt . $this->value;
				} else if( strcmp( $position , "last" ) == 0 ) {
					$string = $this->value . $salt;
				} else {
					throw new exception("Invalid salt location specified, please try again.");
				}
			}
			if( !in_array( $mode , hash_algos() ) ) {
				throw new exception("Invalid or unsupported hashing algorithm specified. Please try again.");
			}
			return $mode( $string );
		} catch( Exception $e ) {
			$this->exception( $e , $e->getMessage() );
		}

	}

	/**
	 * Secures an object using md5 hashing algorithm
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * 
	 * @return string
	 **/
	public final function md5() {

		return md5( $this->value );

	}

	/**
	 * Secures an object using sha1 hashing algorithm
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * 
	 * @return string
	 **/
	public final function sha1() {

		return sha1( $this->value );

	}

	/**
	 * Secures a value for storage in a database by escaping.
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * 
	 * @return string
	 **/
	public final function escape() {

		return mysql_real_escape_string( $this->value );

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
				case "integer":
				case "string":
					return implode(array_reverse($this->chars));
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
	public final function cap( $type ) {

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

		if( is_array( $this->value )) {
			return reset($this->value);
		} else if( isset($this->chars) && is_array( $this->chars )) {
			return $this->chars[0];
		} else {
			return false;
		}

	}

	/**
	 * Returns the last item in an array
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * 
	 * @return mixed
	 **/
	public final function last() {

		if( is_array( $this->value )) {
			return end($this->value);
		} else if( isset($this->chars) && is_array( $this->chars )) {
			return end($this->chars);
		} else {
			return false;
		}

	}

	/**
	 * Returns a JSON object of a value 
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * 
	 * @return string
	 **/
	public final function toJSON() {

		return json_encode( $this->value );

	}

	/**
	 * Returns an array or string from a provided JSON object 
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * 
	 * @return string
	 **/
	public final function fromJSON() {

		return json_decode( $this->value );

	}

	/**
	 * Serializes a dataset 
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * 
	 * @return string
	 **/
	public final function serial() {

		return serialize( $this->value );

	}

	/**
	 * Unserializes a dataset 
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * 
	 * @return mixed
	 **/
	public final function unserial() {

		return unserialize( $this->value );

	}

	/**
	 * Retrieves a specific index from an array 
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * 
	 * @return mixed
	 **/
	public final function index( $key ) {
		if(!is_array( $this->value )) {
			return $this->chars[$key];
		} else {
			return $this->value[$key];
		}

	}	

	/**
	 * Formats the value as a monetary value.
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * 
	 * @return string
	 **/
	public final function money( $symbol = "$" , $decimal = "." ) {

		$num = number_format($this->value);
		if( is_int( $this->value )) {
			return "{$symbol}{$num}{$decimal}00";
		} else if( is_float($this->value) ) {
			return "{$symbol}{$num}";
		} else if( !is_array($this->value) && !is_bool($this->value)) {
			return "{$symbol}{$num}{$decimal}00";
		} else {
			return false;
		}

	}

	/**
	 * Determines if the number is odd or even - EVEN specific
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * 
	 * @return boolean
	 **/
	public final function even() {

		if( $this->value % 2 ) {
			return false;
		} else {
			return true;
		}

	}	

	/**
	 * Determines if the number is odd or even - ODD specific
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * 
	 * @return boolean
	 **/
	public final function odd() {

		if( $this->value % 2 ) {
			return true;
		} else {
			return false;
		}

	}	

	/**
	 * Multiplies the value by a given number
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * 
	 * @return mixed
	 **/
	public final function mult( $times ) {

		return $this->value * $times;

	}	

	/**
	 * Determines the absolute value of a number
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * 
	 * @return mixed
	 **/
	public final function av() {

		return abs($this->value);

	}	

	/**
	 * Determines the greatest common denominator for the value and a provided number
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * 
	 * @return mixed
	 **/
	public final function gcd( $comparison ) {

		return $this->value * $comparison;

	}	

	/**
	 * Rounds the object to a specified place
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * 
	 * @return mixed
	 **/
	public final function rnd( $comparison ) {

		return $this->value * $comparison;

	}	

	/**
	 * Determines if the value is infinite
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * 
	 * @return boolean
	 **/
	public final function infinite() {

		return is_infinite( $this->value );

	}	

	/**
	 * Determines if the value is a number at all
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * 
	 * @return boolean
	 **/
	public final function NaN() {

		return is_nan( $this->value );

	}

	/**
	 * Determines if the value is zero
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * 
	 * @return boolean
	 **/
	public final function zero() {

		if( $this->value != 0 ) {
			return false;
		} else {
			return true;
		}

	}

}


?>