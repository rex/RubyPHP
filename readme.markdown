.# RubyPHP

## The easiest way to bring Ruby-like syntax and functionality to your PHP code.

---

## Background

I recently started learning Ruby and was amazed at the sheer volume of incredibly efficient functionality that every single item had immediately available to it. Virtually anything that I wanted to do to a string, array, integer, etc was available without writing an extra function. Even something as simple as reversing the characters in a string went from this:
    
    <?php
        echo implode( array_reverse( str_split( $string ) ) );
		
		// OR

        echo strrev( $string );
    ?>

To this:

    puts string.reverse

And this gave me an idea. What if I brought this level of convenience and functionality to PHP? And thus, RubyPHP was born.

## Overview

The list of functionality is very, very long ( 66 functions and counting ), but it will be virtually constantly added to as time permits. Help from the community is also appreciated :-P

## What you need

* PHP 5.3+
* Excitement

## How to use the Script
1. Include the script `require_once('class.rubyphp.php');`
2. Remember to include your new PHP file in the `r` namespace. Simply include `namespace r;` at the top of your scripts and you will be in! 
2. Whenever you create or generate data that you want to handle in cool ways, simply instantiate the object with the data inside it. You do *NOT* need to specify a data type. Just instantiate and the code works for you! `$foo = r("bar");`
3. Now that it's instantiated, you simply need to access some of the built-in properties that are created upon instantiation or, if you need something more thorough, run one of the awesome built-in functions. `echo $foo->length` or `echo $foo->flip`. The possibilities are virtually endless.

#Samples - examples using data returned from a database

    $data = $this->db->query('SELECT * FROM `users`'); // Returns an associative array of 10 items

## Arrays

	$f = r($data);

	echo $f->length; 					// 10
	print_r( $f->flip );   			// Shows the array reversed
	print_r( $f->slashes("strip"));	// Recursively iterates through the array and removes the slashes from every single item for display
	print_r( $f->flatten );			// Flattens the array to one dimension and returns it
	print_r( $f->first );				// Displays $data[0]
	print_r( $f->last );				// Displays $data[9]

And many, many more!!

## Say you looped through the dataset and wanted to manipulate things like a boss

	$foo = r( $data );

Data retrieved, let's remove the slashes we added earlier for security purposes. This function returns the `$this` object if chaining is enabled (default: enabled) so you can just say:

	print_r( $foo->slashes('strip')->val );

Let's loop through the entire array. Write your function here just as easily as you always would. The function you write will be applied to each and every member of the array.
#### NOTE: When you write your function, we have to work within PHP 5.3's limitations. If you are *NOT* running PHP 5.4, you are very limited with this function as you cannot access the `$this` object within the anonymous function. PHP 5.3- should stick to the alternative syntax listed below.

	$foo->each( function( $val ) {
		$this->output .= "<tr><td>{$val['name']}</td><td>{$val['email']</td></tr>";
	});
	// Loop over, now we can access that data using $this->output;
	echo "<table>{$this->output}</table>";

#### Alternative syntax, if you want to keep it closer to what you're used to *OR* if you are using a PHP version of less than 5.4: 
	foreach( $foo->val as $k => $v ) {
		$output .= "<tr><td>{$v['name']}</td><td>{$v['email']</td></tr>";
	}
	echo "<table>$output</table>";

## Strings

Perhaps you wanted to do cool things to each individual item during that loop. Let's try it.

	foreach( $foo->val as $k => $v ) {
		$name = r($v['name'])->cap("first")->val;
		$pass = r($v['password'])->md5()->val; // OR $p = $pass->md5; OR $p = $pass->secure('sha512') // NOTE: In the secure() function, you can supply whatever hashing algorithm you want. tiger160,3 , crc32, whatver you want.
		$email = r($v['email'])->tr()->val;

		print "Name: $n, Pass: $p, Email: $e.";
	}

## Numbers

There are lots of cool functions in here just for numbers. A few of my favorites are: 

Integers

	$foo = r(12345);

	print $foo->money;		// $12,345.00
	print $foo->even;		// false
	print $foo->odd;		// true
	print $foo->mult(2);	// 24690
	print $foo->NaN;		// false

Double / Float

	$foo = r(12345.66);

	print $foo->money;		// $12,345.67
	print $foo->even;		// true
	print $foo->odd;		// false
	print $foo->mult(2);	// 24691.32
	print $foo->NaN;		// false


# Notes / Quirks

### 1) When passing a function to `each()`, `each_char()`, or `_call()`, remember that you are working within an `object` context and that to access other functions you must use `$this->function()` syntax.
### 2) For now, running functions on the `r` object does *not* modify the original data, and instead returns the data to you. so to strip slashes from data, you will need to use `$f = $foo->slashes('strip');`.
### 3) This class is still in development. More functions will be added all the time (time permitting) and if `return` values or methods change, I will notate it here and in the code.

# About Me
### Name: Pierce Moore
### Occupation: Web Developer for a 3D animation / rendering / production company in Dallas, Texas, USA. 
### Email: Pierce@PierceMoore.com
### Twitter: <http://twitter.com/kiapierce/>
### Homepage: <http://piercemoore.com/>