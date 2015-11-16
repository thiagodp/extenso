# di

Dependency Injection for PHP.

[![Build Status](https://travis-ci.org/thiagodp/di.svg?branch=master)](https://travis-ci.org/thiagodp/di)

Current [version](http://semver.org/): `0.2` (_not production-ready yet, but usable_)

### Example 1:

```php
class A {}
class B {}

class C {
	public $a, $b;
	function __construct( A $a, B $b ) {
		$this->a = $a;
		$this->b = $b;
	}
}

// Automatically creates A and B, and inject them in C
$c = DI::create( 'C' );
```

### Example 2:

```php
interface MyInterface {
	function say( $what );
}

class MyClass implements MyInterface {
	function say( $what ) { echo $what; }
}

// Configures MyInterface to be created using MyClass
DI::config( DI::let( 'MyInterface' )->create( 'MyClass' ) );

$foo = DI::create( 'MyClass' ); // Create an instance of MyClass
$foo->say( 'hello' );

$bar = DI::create( 'MyInterface' ); // Create an instance of MyClass!
$bar->say( 'world' );
```

### Example 3:

```php
interface I {}

class A {}

class B implements I {}

class C {
	public $i;
	function __construct( I $i ) {
		$this->i = $i;
	}
}

class X {
	public $a, $c;
	function __construct( A $a, C $c ) {
		$this->a = $a;
		$this->c = $c;
	}
}

// Configures "I" to be created using B
DI::config( DI::let( 'I' )->create( 'B' ) );

// Automatically creates and injects "A" and "C", and
// when creates "C", also injects "B" as "I".
$x = DI::create( 'X' );
```

### Example 4:

```php
class A {
	function __construct( $one, $two = 'world' ) {
		echo $one, ', ', $two;
	}
}
// Pass simple constructor arguments as an array
$a = DI::create( 'A', array( 'hello' ) ); // prints hello, world
```

### Example 5:

```php
class A {}

// Makes "A" a shared instance
DI::config( DI::let( 'A' )->shared() );

$a1 = DI::create( 'A' );
$a2 = DI::create( 'A' );
var_dump( $a1 === $a2 ); // bool(true)
```

### Example 6:

```php
interface I {}

class C implements I {}

// Makes "I" a shared instance
DI::config( DI::let( 'I' )->create( 'C' )->shared() );

$i1 = DI::create( 'I' );
$i2 = DI::create( 'I' );
var_dump( $i1 === $i2 ); // bool(true)
```

### Example 7:

```php
interface I {}

class C implements I {}

// Let you using a callable to create the desired instance
DI::config( DI::let( 'I' )->call( function() {
		return new C();
	} ) );

$i = DI::create( 'I' ); // Calls your function to create a "C" instance
```