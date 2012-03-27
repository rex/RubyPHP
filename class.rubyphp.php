<?php

/**
 * 
 * HERE. Let's make a map of the functions that I want to write for this class.
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
 **/

/**
 * I would call this class RubyPHP, but in an effort to make development with this class more efficient, I figured writing $foo = new RubyPHP("$string") a thousand times wasn't worth it.
 * 
 * @package RubyPHP
 * @author Pierce Moore
 * @version 0.1
 * @copyright Pierce Moore 2012 , Refreshed Web Design 2012
 */
class r {

	function __construct( $item ) {

		$this->self = $item;
		$this->value = $item;
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
	public final function exception( Exception $e ) {

		print "#######################################";

		print "Exception: {$e->getMessage} \n";

		print "Stack Trace is as follows: \n <pre>";

		print_r( $e->getTrace() );

		print "#######################################";

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
				case "object":
					$this->buildObj();
					break;
				// If it is an empty or null type or is otherwise not on this list, we spit it back out. OOPSIES
				case null:
				default: 
					throw new exception("Invalid argument or item supplied to RubyPHP. Please try again.");
					break;
			}	
		} catch( Exception $e ) {

			$this->exception( $e );

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
		$this->methods = array("flip","to_s","length","capitalize","lowercase","capFirst");

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



	}

	/**
	 * Still going. Now we're building the "object" object.
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * 
	 * @return boolean
	 * */
	private final function buildObj() {



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

		// Placeholder so I don't forget!

	}

	/**
	 * Returns the stringified version of the object's value. 
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * 
	 * @return mixed
	 **/
	public final function to_s() {

		// Another placeholder!
		return (string)$this->value;

	}

	/**
	 * Simply returns the length of the value. If it's a number or string, it will return the number of characters. If an array or object, it will return the number of elements present. 
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * 
	 * @return int
	 **/
	public final function length() {

		// PLACEHOLDER BRAHHHHHH

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

		// Placeholder so I don't forget!

	}

}

print "<html><head></head><body style=\"background: #cccccc;\"><div style=\"width: 500px;min-height: 300px; padding: 25px; margin: 50px auto; border: 1px #999999 solid; background: #eeeeee;\">";

$a = new r(true);
$b = new r("Pierce");
print_r($b->chars);
//$secure = $b->md5();
// laksjdlkj1290odnlokjslakdj012in
// 1234.50
//$c->isMoney();
$c = new r(1234);
//$c->isMoney();
// $1,234.00
print $c->val() . " , type: " . gettype( $c->val() ) . "<br />";
print $c->to_s() . " , type: " . gettype( $c->to_s() ) . "<br />";
$d = new r(12.34);
$e = new r(new stdclass);
$f = new r(array('thingOne'=>"Thing one!", "thingTwo"=>"Thing two yay!", "three" , "four"));
//print $r->flip();

print "</pre><div style=\"clear:both;\"></div></div></body></html>";

?>