<?php
// Set awesome namespace
namespace PierceMoore\RubyPHP;

/**
 * 
 * HEY THERE! And welcome to RubyPHP, your new best friend. 
 * 
 * Have you ever written code in Ruby and then tried to do the same things in PHP but realized that you definitely couldn't? Yeah. Me too. That's why this class came to be.
 * 
 **/
require_once('includes/class.string.rubyphp.php');
require_once('includes/class.array.rubyphp.php');
require_once('includes/class.boolean.rubyphp.php');
require_once('includes/class.number.rubyphp.php');

// Let's write a function that you can use in your own code to decrease the size of object instantiation. 
function r( $item ) {
	switch( gettype( $item )) {
		case "array":
			return new rArray($item);
			break;
		case "integer":
		case "float":
			return new rNumber($item);
			break;
		case "string":
			return new rString($item);
			break;
		case "boolean":
			return new rBoolean($item);
			break;
		default:
			return $item;
	}

}
/*
As long as you use the above function, your code will go from this:

$f = new r("Pierce");

to

$f = r("Pierce"); 

That's about as easy as it gets.

*/

/**
 * I would call this class RubyPHP, but in an effort to make development with this class more efficient, I figured writing $foo = new RubyPHP("$string") a thousand times wasn't worth it. So I decided $foo = r("bar"); was better.
 * 
 * @package RubyPHP
 * @brief Taking all the beautiful simplicity of Ruby and implementing it in PHP!
 * @author Pierce Moore
 * @version 0.1
 * @copyright Pierce Moore 2012 , Refreshed Web Design 2012
 */
class r {

	/**
	* First we declare all our publicly accessible variables for each data type. These will be accessible by $foo->$var. 
	* 
	* ex:
	* $foo = r("$string");
	* print $foo->length;
	* print $foo->even;
	* print $foo-slashes;
	* 
	* etc..
	* */

	public $to_s;
	public $to_f;
	public $to_i;
	public $to_int;
	public $length;
	public $capitalize;
	public $count;
	public $isMoney;
	public $even;
	public $odd;
	public $reverse;
	public $md5;
	public $sha1;
	public $val;
	public $trim;
	public $slashes;
	public $flipArray;
	public $chaining = false;
	public $debug = false;
	public $chars;
	public $methods;

	public $autoMethods = array(
		"val",
		"flip",
		"reverse",
		"to_s",
		"to_f",
		"to_i",
		"to_int",
		"length",
		"md5",
		"sha1",
		"downcase",
		"first",
		"last",
		"slashes",
		"count",
		"shuf"
	);

	function __construct( $item , $chaining = false , $debug = false ) {

		$this->self = $item;
		$this->val = $item;
		$this->origVal = $this->val;
		$this->type = gettype( $item );

		$this->setChaining( $chaining );
		$this->setDebug( $debug );

		if( $this->debug )
			$this->showObject();

		return $this;
	}

	/**
	 * Just a plain utility function to deal with errors. 
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * @fn exception()
	 * @param Exception $e - The function that threw the exception
	 * @param string $msg - The message that was thrown
	 * @return void
	 * */
	public function exception( Exception $e , $msg ) {

		print "####################################### \n\n<br /><br />";

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
	 * A pre-emptive security function. You are free to run all functions as-is, but if you want to ensure that nothing weird happens when trying 
	 * to run a method or access a property, use this function to determine whether or not that method or property is valid.
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * @fn responds_to()
	 * @param string $function - The function that you are trying to test for
	 * @return boolean
	 * */
	public function responds_to( $function ) {
		return in_array( $function , $this->methods );
	}

	/**
	 * This utility function will call a user-provided function on the data object.
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * @fn _call()
	 * @param string $function - The user-supplied function that will be run against the object value
	 * @return mixed
	 **/
	public function _call( $function ) {

		return $function( $this->val );

	}

	/**
	 * Set the global chaining switch on/off
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * @fn setChaining()
	 * @param boolean $mode - True/False mode for global chaining. Defaults to on because it's just better that way.
	 * @return mixed
	 **/
	public function setChaining( $mode ) {

		$this->chaining = $mode;
		return $this;

	}

	/**
	 * Set the global debug switch on/off
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * @fn setDebug()
	 * @param boolean $mode - True/False mode for global debug. Defaults to on because it's just better that way.
	 * @return mixed
	 **/
	public function setDebug( $mode ) {

		$this->debug = $mode;
		return $this;

	}

	/**
	 * An easy function that will send data depending on whether or not global chaining is enable. If enabled, returns $this. If disabled, simply returns value.
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * @fn chain()
	 * @param mixed $data - The data that could be returned.
	 * @return mixed
	 **/
	public function chain( $data ) {

		if( $this->chaining ) {
			$this->val = $data;
			return $this;
		} else {
			return $data;
		}

	}

	/**
	 * Just a simple utility function to display the formatted object.
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * @fn showObject()
	 * @return void
	 * */
	public function showObject( $fetch = false ) {

		if( $fetch ) {
			return $this;
		} else {
			print "<pre>";
			print_r( $this );
			print "</pre>";
		}

	}

	/**
	 * With every object instantiation, let's build the basic data that will be present for every single type of value.
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * @fn runMethods()
	 * @return void
	 **/
	protected function runMethods() {

		foreach( $this->autoMethods as $k=>$v ) {
			$this->$v = $this->$v();
		}

	}

	/**
	 * Simple val() function, returns the value of the object. 
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * @fn val()
	 * @return mixed
	 **/
	public function val() {

		return $this->val;

	}

	/**
	 * Dumps the contents of the object 
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * @fn dump()
	 * @return mixed
	 **/
	public function dump() {

		var_dump( $this->val );

	}

	/**
	 * Destroys an object 
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * @fn destroy()
	 * @return void
	 **/
	public function destroy() {

		foreach( $this as $k => $v ){
			unset( $this->$k );
		}

	}

	/**
	 * Secures an object 
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * @fn secure()
	 * @param string $mode - The hashing method to use. Accepts "md5" or "sha1"
	 * @param string $salt - The salt to use on the item prior to it being hashed. Default: null (no salt)
	 * @param string $position - The position to place the salt. Accepts "first" or "last". Default: Null (no salt position)
	 * @return string
	 **/
	public function secure( $mode = "sha1" , $salt = null , $position = null ) {

		try {
			if( is_array($this->val)) {
				throw new exception("Arrays are not allowed to be secured. Please try again.");
			}
			$string = $this->val;
			if( $salt != null ) {
				if( strcmp( $position , "first" ) == 0 ) {
					$string = $salt . $this->val;
				} else if( strcmp( $position , "last" ) == 0 ) {
					$string = $this->val . $salt;
				} else {
					throw new exception("Invalid salt location specified, please try again.");
				}
			}
			if( !in_array( $mode , hash_algos() ) ) {
				throw new exception("Invalid or unsupported hashing algorithm specified. Please try again.");
			}
			return $this->chain( $mode( $string ) );
		} catch( Exception $e ) {
			$this->exception( $e , $e->getMessage() );
		}

	}

	/**
	 * Secures an object using md5 hashing algorithm
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * @fn md5()
	 * @return string
	 **/
	public function md5() {

		if( $this->type == "array" ) {
			return false;
		}

		return $this->chain( md5( $this->val ) );

	}

	/**
	 * Secures an object using sha1 hashing algorithm
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * @fn sha1()
	 * @return string
	 **/
	public function sha1() {

		if( $this->type == "array" ) {
			return false;
		}
		return $this->chain( sha1( $this->val ) );

	}

	/**
	 * Adds/Removes slashes based on input
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * @fn slashes()
	 * @param mixed $mode - The method of slashes to use. DEFAULT: "add", ACCEPTS: "add","addc","strip","stripc"
	 * @return mixed
	 **/
	public function slashes( $mode = "add" ) {

		switch( $mode ) {
			case "add":
			case "addc":
			case "strip":
			case "stripc":
				$f = $mode . "slashes";
				break;
			default:
				return $this->val;
		}

		if( $this->type == "string" || is_array( $this->chars) ) {
			print "Type: {$this->type}.<br />";
			print_r($this->val);
			return $this->chain( $f( $this->val ) );
		} else if( $this->type == "array" ) {
			return $this->chain( $this->arraySlash( $this->val , $f ) );
		}
		$this->error = "Invalid data type sent to slashes(). Only strings and arrays are accepted.";
		return false;

	}

	/**
	 * Returns the REVERSE of the object. If it's a boolean, it will act like an on/off switch. For arrays, strings, and numbers it will just reverse the order of the characters. 
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * @fn flip()
	 * @return mixed
	 **/
	public function flip() {

		switch( $this->type ) {

			case "boolean":
				return $this->chain( !$this->val );
				break;
			case "integer":
			case "float":
			case "string":
				if( !empty( $this->chars )) {
					$this->flipArray = array_reverse( $this->chars );
					return $this->chain( implode(array_reverse($this->chars)) );	
				}
				break;
			case "array":
				$this->flipArray = array_reverse( $this->val );
				return $this->chain( $this->flipArray );
				break;
			default:
				return null;
		}

	}

	/**
	 * Returns the stringified version of the object's value. 
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * @fn to_s()
	 * @return string
	 **/
	public function to_s() {

		return $this->chain( (string)$this->val );

	}

	/**
	 * Returns the integer version of the object's value. 
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * @fn to_i()
	 * @return int
	 **/
	public function to_i() {

		return $this->chain( (int)$this->val );

	}

	/**
	 * Returns the integer version of the object's value. ## DIFFERENT SYNTAX ##
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * @fn to_int()
	 * @return int
	 **/
	public function to_int() {

		return $this->chain( (int)$this->val );

	}

	/**
	 * Returns the floating point decimal version of the object's value.
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * @fn to_f()
	 * @return float
	 **/
	public function to_f() {

		return $this->chain( (float)$this->val );

	}

	/**
	 * Simply returns the length of the value. If it's a number or string, it will return the number of characters. If an array or object, it will return the number of elements present. 
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * @fn length()
	 * @return int
	 **/
	public function length( $mode = COUNT_NORMAL ) {

		if( !is_array( $this->val )) {

			return $this->chain( strlen( (string)$this->val ) );

		} else if (is_array( $this->val )) {

			return $this->chain( count( $this->val , $mode ) );
		}

	}

	/**
	 * Returns the first item in an array
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * @fn first()
	 * @return mixed
	 **/
	public function first() {

		if( is_array( $this->val )) {
			return $this->chain( reset($this->val) );
		} else if( isset($this->chars) && is_array( $this->chars )) {
			return $this->chain( reset($this->chars) );
		} else {
			return false;
		}

	}

	/**
	 * Returns the last item in an array
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * @fn last()
	 * @return mixed
	 **/
	public function last() {

		if( is_array( $this->val )) {
			return $this->chain( end($this->val) );
		} else if( isset($this->chars) && is_array( $this->chars )) {
			return $this->chain( end($this->chars) );
		} else {
			return false;
		}

	}

	/**
	 * Adjusts the entire case of a string to lower
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * @fn downcase()
	 * @return mixed
	 **/
	public function downcase() {

		if( $this->type == "string" ) {
			return $this->chain( strtolower( $this->val ) );
		} else {
			return $this->val;
		}

	}

	/**
	 * Matches a regex against the object value and returns the occurrences
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * @fn match()
	 * @param string $pattern - The pattern that the regex will follow.
	 * @return mixed
	 **/
	public function match( $pattern ) {

		if( preg_match( $pattern , $this->val , $matches ) ) {
			return $this->chain( $matches );
		}
		return false;

	}

	/**
	 * Runs a function against each of the characters in the object string or the elements in the object array.
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * @fn each()
	 * @param string $function - The user-supplied function that will be run against the characters or elements
	 * @return mixed
	 **/
	public function each( $function ) {

		if( $this->type == "string" ) {
			foreach( $this->chars as $k => $v ) {
				$output[] = $function( $v );
			}
		} else if ( $this->type == "array" ) {
			foreach( $this->val as $k => $v ) {
				$output[] = $function( $v );
			}
		} else if ( is_array( $this->chars )) {
			foreach( $this->chars as $k => $v ) {
				$output[] = $function( $v );
			}
		} else {
			return $this->val;
		}
		return $this->chain( $output );

	}

	/**
	 * Reverses the elements of an array or the characters in a string/double/integer/etc. This is an alias of flip()!
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * @fn reverse()
	 * @return mixed
	 **/
	public function reverse() {

		return $this->chain( $this->flip() );

	}

	/**
	 * Determines whether a provided value is equal to the object value or not
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * @fn eql()
	 * @param mixed $comparison - The value to be compared to.
	 * @return boolean
	 **/
	public function eql( $comparison ) {

		if( !isset( $comparison )) {
			return $this->val;
		}
		if( $this->type == "string" ) {
			return ( strcmp( $this->val , $comparison ) == 0 );
		} else {
			return $this->val == $comparison;
		}

	}

	/**
	 * Breaks apart a string of values into separate array pieces by a provided delimiter
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * @fn ex()
	 * @param string $delimiter - The character separator used to break the string apart
	 * @return mixed
	 **/
	public function explode( $delimiter ) {

		if( !isset($delimiter)) {
			return $this->val;
		}
		return $this->chain( explode( $delimiter , $this->val ) );

	}

	/**
	 * Flattens an array using a provided delimiter
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * @fn im()
	 * @param string $delimiter - The character separator to include between characters.
	 * @return mixed
	 **/
	public function implode( $delimiter ) {

		if( !isset($delimiter)) {
			return $this->val;
		}
		if( is_array( $this->val )) {
			return $this->chain( implode( $delimiter , $this->val ));
		} else if( is_array( $this->chars ) ) {
			return $this->chain( implode( $delimiter , $this->chars ));
		}

	}

	/**
	 * Repeats a string, number or array $num of times.
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * @fn repeat()
	 * @param int $num - Number of times to be repeated
	 * @return mixed
	 **/
	public function repeat( $num ) {
		if( $num <= 0 || is_nan( $num )) {
			return $this->val;
		}
		$return = "";
		if( $this->type == "array" ) {
			for( $i = 0; $i < $num; $i++ ) {
				$return .= $this->val;
			}
		} else if( is_array( $this->chars ) ) {
			$return = str_repeat( $this->val , $num );
		} else {
			$return = $this->val;
		}
		return $return;

	}

	/**
	 * Counts the elements of a string or an array
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * @fn cnt()
	 * @param int $mode - The count mode: null ) Normal, top-level count. 1) Recursive count. Counts all levels. <DEFAULT
	 * @return mixed
	 **/
	public function count( $mode = 1 ) {

		if( $this->type == "string" ) {
			$this->count = count( $this->chars , $mode );
		} else if( $this->type == "array" ) {
			$this->count = count( $this->val , $mode );
		} else {
			return $this->val;
		}
		if( $this->chaining ){
			return $this;
		} else {
			return $this->count;
		}

	}

	/**
	 * Searches for a key or item in a string, integer, double, or array.
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * @fn pos()
	 * @param mixed $needle - The search term.
	 * @param boolean $recursive - Whether or not to recurse into the value array
	 * @return mixed
	 **/
	public function pos( $needle , $recursive = true ) {

		if( !isset( $needle )) {
			return $this->val;
		}
		$search = function( $key , $haystack ) {
			if( is_array( $haystack )) {
				return array_search( $key , $haystack );
			} else {
				return strpos( $haystack , $key );
			}
		};

		if( $this->type == "string" || is_array( $this->chars) ) {
			return $search( $needle , $this->chars );
		} else if( $this->type == "array" ) {
			return array_walk_recursive( $this->val , $search );
		}
		return $this->val;

	}

	/**
	 * Multipurpose replace function. Regex for strings and numbers, and a key->val replace for arrays.
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * @fn replace()
	 * @param string $item - The pattern or key to match against (regex)
	 * @param mixed $replacer - The item that will replace the found key
	 * @param boolean $recursive - Flag whether or not the function will recurse into the provided array
	 * @return mixed
	 **/
	public function replace( $item , $replacer , $recursive = true ) {
	
		if( !isset( $item ) || !isset( $replacer ) ) {
			$this->error = "One or more arguments missing for replace(). Please try again.";
			return false;
		}
		if( $this->type == "array" ) {
			if( in_array( $item , $this->val )) {
				$key = array_search( $item , $this->val );
				$this->val[$key] = $replacer;
			} else {
				if( $recursive ) {
					return $this->chain( $this->arrayReplace( $this->val , $item , $replacer ) );
				} else {
					return $this->val;
				}
			}	
		} else if( $this->type == "string"  || is_array( $this->chars )) {
			return $this->chain( preg_replace( $item , $replacer , $this->val ) );
		} else {
			$this->error = "Invalid data type for replace(). Please try again.";
			return false;
		}

	}

	/**
	 * Shuffles an array and returns it. Useful for random selection.
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * @fn shuf()
	 * @return mixed
	 **/
	public function shuf() {

		if( $this->type == "array" ) {
			$arr = $this->val;
			shuffle( $arr );
			return $this->chain( $arr );
		} else if( $this->type == "string" ) {
			$arr = $this->chars;
			shuffle( $arr );
			return $this->chain( $arr );
		}
		if( $this->chaining ) {
			return $this;
		} else {
			return $this->val;
		}

	}

}

?>