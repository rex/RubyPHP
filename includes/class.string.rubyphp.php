<?php
namespace PierceMoore\RubyPHP;

/**
 * Class to separate String logic from bulk of RubyPHP
 * 
 * @package RubyPHP
 * @subpackage String
 * @author Pierce Moore
 * @copyright 2012 
 * @version 0.1.1
 * */
class rString extends r {
	
	function __construct( $item ) {
		parent::__construct( $item );
		$this->buildString();
		$this->runMethods();
		$this->showObject();
	}

	/**
	 * Still going. Now we're building the "string" object.
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * @fn buildString()
	 * @return boolean
	 * */
	protected function buildString() {

		$this->valString = $this->val;
		$this->chars = str_split( $this->val );
		return $this->val;

	}

	/**
	 * Runs a function against each of the characters in the object string ($this->chars)
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * @fn each_char()
	 * @param string $function - The user-supplied function that will be run against the characters
	 * @return mixed
	 **/
	public function each_char( $function ) {

		if( is_array( $this->chars ) ) {
			foreach( $this->chars as $k => $v ) {
				$output[] = $function( $v );
			}
			return $this->chain( $output );
		}
		return $this->val;

	}

	/**
	 * Trims all whitespace from the beginning and end of the object value. 
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * @fn tr()
	 * @return mixed
	 **/
	public function tr() {

		if( $this->type == "string" ) {
			return $this->chain( trim( $this->val ) );
		} else {
			return $this->val;
		}

	}

	/**
	 * Secures a value for storage in a database by escaping.
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * @fn escape()
	 * @return string
	 **/
	public function escape() {

		if( $this->type == "array" ) {
			return false;
		}
		return $this->chain( mysql_real_escape_string( $this->val ) );

	}

	/**
	 * Deals with casing in strings. Is used to modify the upper- and lower-case nature of the string. 
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * @fn cap()
	 * @param string $type - The parameters that the capitalize function must work within. Accepts: "first" , "all" , "none" , "words"
	 * @param mixed $value - The value to be modified. I found that this parameter was necessary for other functions that required casing and needed to pass their own values.
	 * @return string
	 **/
	public function cap( $type , $value = null ) {

		if( !isset( $value ) || value == null ) {
			$value = $this->val;
		}

		switch( $type ) {

			case "first":
				return $this->chain( ucfirst( strtolower( $value )) );
				break;
			case "all":
				return $this->chain( strtoupper( $value ) );
				break;
			case "none":
				return $this->chain( strtolower( $value ) );
				break;
			case "words":
				return $this->chain( ucwords( strtolower( $value )) );
				break;
			default: 
				$this->error = "Invalid capitalization mode supplied. 'first', 'all', 'none', and 'words' are acceptable.";
				return false;
		}

	}

	/**
	 * Takes a string and reverses the case of each of the letters. All capitals become lowercase and vice-versa
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * @fn swapcase()
	 * @return mixed
	 **/
	public function swapcase() {

		if( $this->type != "string" ) {
			return $this->val;
		}
		$return = array();
		foreach( $this->chars as $k=>$v) {
			if( ctype_upper( $v )) {
				$return[] = strtolower( $v );
			} else if( ctype_lower( $v )) {
				$return[] = strtoupper( $v );
			}
			return $this->chain( implode( $return ) );
		}

	}

}

?>