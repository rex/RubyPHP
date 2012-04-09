<?php
namespace PierceMoore\RubyPHP;

/**
 * Class to separate Number logic from bulk of RubyPHP
 * 
 * @package RubyPHP
 * @subpackage Number
 * @author Pierce Moore
 * @copyright 2012 
 * @version 0.1.1
 * */
class rNumber extends r {

	function __construct( $item ) {
		parent::__construct( $item );
		$this->buildNumber();
		$this->runMethods();
	}

	/**
	 * Let's build the object for numbers. Floats/Doubles/Integers are all welcome here.
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * @fn buildInteger()
	 * @return boolean
	 * */
	function buildNumber() {
		$this->valString = $this->to_s($this->val);
		return $this->val;	
	}/**
	 * 
	 * ################################################################
	 * 
	 * 			NUMBER FUNCTIONS, yay! (This includes float and int)
	 * 
	 * ################################################################
	 * 
	 * */

	/**
	 * Formats the value as a monetary value.
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * @fn money()
	 * @param string $symbol - The currency denominator to use
	 * @param string $decimal - The decimal separator
	 * @return string
	 **/
	public function money( $symbol = "$" , $decimal = "." ) {

		$num = @number_format($this->val);
		if( is_int( $this->val )) {
			return $this->chain( "{$symbol}{$num}{$decimal}00" );
		} else if( is_float($this->val) ) {
			return $this->chain( "{$symbol}{$num}" );
		} else if( !is_array($this->val) && !is_bool($this->val)) {
			return $this->chain( "{$symbol}{$num}{$decimal}00" );
		} else {
			return $this->chain( $this->val );
		}

	}

	/**
	 * Determines if the number is odd or even - EVEN specific
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * @fn even()
	 * @return boolean
	 **/
	public function even() {

		if( $this->val % 2 ) {
			$this->even = false;
		} else {
			$this->even = true;
		}
		if( $this->chaining ) {
			return $this;
		} else {
			return $this->even;
		}

	}	

	/**
	 * Determines if the number is odd or even - ODD specific
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * @fn odd()
	 * @return boolean
	 **/
	public function odd() {

		if( $this->val % 2 ) {
			$this->odd = false;
		} else {
			$this->odd = true;
		}
		if( $this->chaining ) {
			return $this;
		} else {
			return $this->odd;
		}

	}	

	/**
	 * Multiplies the value by a given number
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * @fn mult()
	 * @param mixed $times - The multiplier
	 * @return mixed
	 **/
	public function mult( $times ) {

		return $this->chain( $this->val * $times );

	}	

	/**
	 * Determines the absolute value of a number
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * @fn av()
	 * @return mixed
	 **/
	public function av() {

		return $this->chain( abs($this->val) );

	}	

	/**
	 * Determines the greatest common denominator for the value and a provided number
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * @fn gcd()
	 * @param mixed $comparison - The number to find the GCD with
	 * @return mixed
	 **/
	public function gcd( $comparison ) {

		return $this->chain( $this->val * $comparison );

	}	

	/**
	 * Rounds the object to a specified place
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * @fn rnd()
	 * @param int $place - The precision with which you would like to round the number.
	 * @return mixed
	 **/
	public function rnd( $place ) {

		if( $this->NaN( $this->val ) ) {
			return $this->chain( $this->val );
		}
		return $this->chain( round( $this->val , $place ) );

	}	

	/**
	 * Determines if the value is infinite
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * @fn infinite()
	 * @return boolean
	 **/
	public function infinite() {

		return $this->chain( is_infinite( $this->val ) );

	}	

	/**
	 * Determines if the value is a number at all
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * @fn NaN()
	 * @return boolean
	 **/
	public function NaN() {

		$this->NaN = is_nan( (double)$this->val );
		if( $this->chaining ) {
			return $this;
		} else {
			return $this->NaN;
		}

	}

	/**
	 * Determines if the value is zero
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * @fn zero()
	 * @return boolean
	 **/
	public function zero() {

		if( $this->val != 0 ) {
			$this->zero = false;
		} else {
			$this->zero = true;
		}
		if( $this->chaining ) {
			return $this;
		} else {
			return $this->zero;
		}

	}

	/**
	 * Returns the decimal value for the object value
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * @fn hex()
	 * @return mixed
	 **/
	public function hex() {

		if( $this->type == "string" ) {
			return $this->chain( hexdec( $this->val ) );
		} else {
			return $this->val;
		}

	}

	/**
	 * Returns the hex value for the object value
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * @fn toHex()
	 * @return mixed
	 **/
	public function toHex() {

		if( $this->type == "string" ) {
			return $this->chain( dechex( $this->val ) );
		} else {
			return false;
		}

	}

}

?>