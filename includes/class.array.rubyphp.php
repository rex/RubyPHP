<?php
namespace PierceMoore\RubyPHP;

/**
 * Class to separate Array logic from bulk of RubyPHP
 * 
 * @package RubyPHP
 * @subpackage Array
 * @author Pierce Moore
 * @copyright 2012 
 * @version 0.1.1
 * */
class rArray extends r {
	
	function __construct( $item ) {

		$this->val = $item;
		
	}

}

?>