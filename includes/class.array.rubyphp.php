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
		parent::__construct( $item );
		$this->buildArray();
		$this->runMethods();
	}

	/**
	 * Still going. Now we're building the "array" object.
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * @fn buildArray()
	 * @return boolean
	 * */
	protected function buildArray() {

		$this->valString = null;
		return $this;
	}

	/**
	 * Sorts an array according to the provided parameters.
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * @fn srt()
	 * @return mixed
	 **/
	public function srt( $method = 'sort') {

		if( !is_array( $this->val ) ) {
			return $this->val; 
		}
		return $method( $this->val );

	}

	/**
	 * Places an item into a pre-existing array at the specified location. Default: "end"
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * @fn push()
	 * @param mixed $item - The item to be placed into the array
	 * @param string $location - The item to be 
	 * @return mixed
	 **/
	public function push( $item , $location = "end" ) {

		try {

			if( !is_array( $this->val ) ) {
				return $this->val; 
			} else {
				switch( $location ) {
					case "fin":
					case "end":
						return $this->chain( array_push( $this->val , item ) );
						break;
					case "start":
					case "beg":
						return $this->chain( array_unshift( $this->val , $item ) );
						break;
					default:
						throw new exception("Invalid location specified in push(). The function accepts 'beg','start','fin', and 'end'");
				}
			}
		} catch( Exception $e ) {
			$this->exception( $e , $e->getMessage() );
		}

	}

	/**
	 * Rotates an array (first element becomes last element, second element becomes first.) 
	 * 
	 * NOTE: THIS IS A VERY ROUGH CUT. Just.. Bear with me.
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * @fn rotate()
	 * @return array
	 **/
	public function rotate() {

		if( !is_array( $this->val ) ) {
			return $this->$this->val;
		}
		return $this->chain( array_push(array_shift( $this->val )) );

	}

	/**
	 * Returns a random sample of an array of a specified number of elements.
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * @fn sample()
	 * @param int $size - The number of random elements to return.
	 * @return mixed
	 **/
	public function sample( $size = 1 ) {

		$return = array();

		if( !is_array( $this->val ) ) {
			return $this->val; 
		}
		if( count( $this->val ) < $size ) {
			$size = count( $this->val );
		}
		for( $i = 0; $i < $size; $i++ ) {
			$key = array_rand( $this->val );
			$return[] = array( $key => $this->val[$key] );
		}
		$this->sample = $return;
		if( $this->chaining ) {
			return $this;
		} else {
			return $this->sample;
		}
		

	}

	/**
	 * Slices a specific part of the array and returns it. If the provided "start" offset is larger than the largest key, an exception will be thrown.
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * @fn slice()
	 * @param int $start - The starting index of the slice
	 * @param int $count - The size of the slice. 
	 * @return mixed
	 **/
	public function slice( $start = 0 , $count = null ) {

		try {
			if( $count == null ) {
				throw new exception("The size of the desired slice is required, but was not provided. Please provide both the starting point and the size of the slice.");
			}
			if( is_array( $this->val ) ) {
				if( $start > count( $this->val ) ) {
					throw new exception("The key you provided is greater than the highest key in the array. Please select a smaller starting key.");
				}
				$return = array_slice( $this->val , $start , $count );
			} else if( is_string( $this->val )) {
				if( $start > count( $this->val ) ) {
					throw new exception("The key you provided is greater than the highest key in the character array. Please select a smaller starting key.");
				}
				$return = array_slice( $this->chars , $start , $count );
			} else {
				throw new exception("You are trying to slice an unsupported data type. Please try again.");
			}
			$this->slice = $return;
			if( $this->chaining ) {
				return $this;
			} else {
				return $this->slice;
			}
		} catch( Exception $e ) {
			$this->exception( $e , $e->getMessage() );
		}

	}

	/**
	 * "Cleans" an array by removing all duplicate elements and returning the array with no duplicates.
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * @fn uniq()
	 * @return mixed
	 **/
	public function uniq() {

		if( is_array( $this->val )) {
			array_unique( $this->val );
		} else if( is_array( $this->chars )) {
			array_unique( $this->chars );
		}
		$return = $this->val;
		if( $this->chaining ) {
			return $this;
		} else {
			return $return;
		}

	}

	/**
	 * "Zip" takes multiple arrays and interlaces them at their matching positions
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * @fn zip()
	 * @todo Check to see if array_map() is more effective here than the solution I found.
	 * @param mixed $args - This function accepts as many arguments as you throw at it. It will hard-typecast all arguments into arrays and go from there. 
	 * @return mixed
	 **/
	public function zip( $args ) {

		$val = (array)$this->val;
		$data = array();
		$return = array();
		$max = 0;
		foreach( func_get_args() as $k=>$v ) {
			$data[] = (array)$v;
		}
		$data[] = $val;
		foreach( $data as $k=>$v ) {
			if( count( $v ) > $max ) {
				$max = count( $v );
			}
		}

		for( $i = 0; $i < $max; $i++ ) {
			foreach( $data as $k=>$v ) {
				if( isset( $data[$k][$i]) ) {
					$return[$i][] = $data[$k][$i];
				} else {
					$return[$i][] = null;
				}
			} 
		}

		return $this->chain( $return );

	}

	/**
	 * Returns a JSON object of a value 
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * @fn toJSON()
	 * @return string
	 **/
	public function toJSON() {

		return $this->chain( json_encode( $this->val ) );

	}

	/**
	 * Returns an array or string from a provided JSON object 
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * @fn fromJSON()
	 * @return string
	 **/
	public function fromJSON() {

		return $this->chain( json_decode( $this->val ) );

	}

	/**
	 * Serializes a dataset 
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * @fn serial()
	 * @return string
	 **/
	public function serial() {

		return $this->chain( serialize( $this->val ) );

	}

	/**
	 * Unserializes a dataset 
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * @fn unserial()
	 * @return mixed
	 **/
	public function unserial() {

		return $this->chain( unserialize( $this->val ) );

	}

	/**
	 * Retrieves a specific index from an array 
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * @fn index()
	 * @param int $key - The key to locate
	 * @return mixed
	 **/
	public function index( $key ) {
		if( $key > count( $this->val )) {
			return $this->chain( $this->val );
		}
		if(!is_array( $this->val )) {
			return $this->chain( $this->chars[$key] );
		} else {
			return $this->chain( $this->val[$key] );
		}

	}	

	/**
	 * Appends the elements of a provided array to the r object.
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * @fn concat()
	 * @param mixed $item - The item that you would like appended to the object value array. Preferred: Array 
	 * @param string $position - The position in the array you would like the value appended. Accepts "start" "fin" "begin" and "end"
	 * @return mixed
	 **/
	public function concat( $item , $position = "end" ) {

		$val = (array)$item;
		if( !is_array( $this->val ) && !is_array( $this->chars )) {
			return $this->val;
		}
		switch( $position ) {
			case "start":
			case "begin":
				if( is_array( $this->val )) {
					$return = array_unshift( $this->val , $val );
				} else if( is_array( $this->chars )) {
					$return = implode( array_unshift( $this->chars , $val ));
				}
				break;
			case "fin":
			case "end":
				if( is_array( $this->val )) {
					$return = array_push( $this->val , $val);
				} else if( is_array( $this->chars )) {
					$return = implode( array_push( $this->chars , $val ) );
				}
				break;
			default:
				return false;
		}
		return $this->chain( $return );

	}

	/**
	 * Prepends a value to the front of an array or a string
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * @fn prepend()
	 * @param mixed $item - The item to be prepended to the existing array
	 * @return mixed
	 **/
	public function prepend( $item ) {

		if( !is_array( $this->val ) && !is_array( $this->chars )) {
			return $this->val;
		}
		if( is_array( $this->val )) {
			return $this->chain( array_unshift( $this->val , $item ) );
		} else if( is_array( $this->chars )) {
			return $this->chain( imploade( array_unshift( $this->chars, $item)) );
		} else {
			return $this->val;
		}

	}

	/**
	 * Adds/Removes slashes in an array. This is a recursive function, and will secure all levels of an n-dimensional array.
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * @fn slash()
	 * @param array $array - The array to be recursed through.
	 * @param mixed $mode - This is the function to use. Passed to the function initially by slashes(). 
	 * @return mixed
	 **/
	public function arraySlash( $array , $mode ) {

		foreach( $array as $k=>$v ){
			if( is_array( $v )) {
				$output[] = $this->arraySlash( $v , $mode );
			} else {
				$output[$k] = $mode( $v );
			}
		}
		return $this->chain( $output );

	}

	/**
	 * Recursive array replacement function.
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * @fn arrayReplace()
	 * @param array $array - The Haystack to search in
	 * @param string $item - The pattern or key to match against (regex)
	 * @param mixed $replacer - The item that will replace the found key
	 * @return mixed
	 **/
	public function arrayReplace( $array , $item , $replacer ) {
		foreach( func_get_args() as $k=>$v ) {
			if( empty($v) ) {
				return $this->val;
			}
		}
		if( !is_array( $array )) {
			return $this->val;
		}
		// Test if $item is a regex
		$regex = strpos( $item , "/");
		foreach( $array as $k=>$v ){
			if( is_array( $v )) {
				$output[$k] = $this->arrayReplace( $v , $item , $replacer );
			} else {
				if( strpos( $v , $item ) || ( strcmp( $v , $item ) == 0 )) {
					$output[$k] = str_replace( $item , (string)$replacer, $v );
				} else if( $regex ) {
					$output[$k] = preg_replace( $item , (string)$replacer, $v );
				} else {
					$output[$k] = $v;
				}
			}
		}
		return $output;
	}

	/**
	 * Flattens an array into a single dimension. 
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * @fn flatten()
	 * @param mixed $val - The value of the flattened keypair
	 * @param mixed $key - The key of the flattened keypair
	 * @return array
	 **/
	public function flatten( $val = null , $key = null ) {
		if( isset($val) && isset($key)) {
			$this->output[$key] = $val;
		} else {
			if( $this->type == "array" ) {
				$this->output = array();
				array_walk_recursive( $this->val , array( $this , "flatten"));
				return $this->output;
			}	
		}
	}

	/**
	 * Removes a specified key from an array.
	 * 
	 * @package RubyPHP
	 * @author Pierce Moore
	 * @fn del()
	 * @param mixed $key - The key to remove from the array
	 * @return mixed
	 **/
	public function delete( $key ) {

		if( $this->type == "string" ) {
			if( $key > count( $this->chars )) {
				return $this->val;
			}
			unset( $this->chars[$key] );
			$return = $this->chars;
		} else if( $this->type == "array" ) {
			if( $key > count( $this->val )) {
				return $this->val;
			}
			unset( $this->val[$key] );
			$return = $this->val;
		} else {
			$return = $this->val;
		}

		return $this->chain( $return );

	}

}

?>