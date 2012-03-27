<?php

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
		$this->self->info = $this->buildObject();

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

		print "<html><head></head><body><div style=\"width: 500px;height: 300px; padding: 25px; margin: 50px auto; border: 1px red solid; background: #dddddd;\">";

		print "Exception: {$e->getMessage} \n";

		print "Stack Trace is as follows: \n";

		print_r( $e->getTrace() );

		print "</div></body></html>";

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

			$this->self->type = gettype( $s );

			switch( $this->self->type ) {

				case "boolean":
					$this->buildBoolean();
					break;
				default: 


			}	
		} catch( Exception $e ) {

			$this->exception( $e );

		}

	}

}

?>