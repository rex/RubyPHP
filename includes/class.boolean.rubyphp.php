<?php
namespace PierceMoore\RubyPHP;

/**
 * Class to separate Boolean logic from bulk of RubyPHP
 * 
 * @package RubyPHP
 * @subpackage Boolean
 * @author Pierce Moore
 * @copyright 2012 
 * @version 0.1.1
 * */
class rBoolean extends r {

	function __construct( $item ) {
		parent::__construct( $item );
		$this->buildBoolean();
		$this->runMethods();
	}

	/**
	 * Let's go down the list, doing the easy stuff first.
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * @fn buildBoolean()
	 * @return boolean
	 **/
	protected function buildBoolean() {

		$this->val = ( $this->self ) ? 1 : 0;
		$this->valString = ( $this->val ) ? "true" : "false";
		return $this->val;
	}

}

?>