<?php
namespace phputil\extenso\tests;

use phputil\extenso\Extenso;

/**
 *	Tests Extenso.
 *
 *	@author	Thiago Delgado Pinto
 */
class ExtensoTest extends \PHPUnit_Framework_TestCase {
	
	private $e; // Extenso
		
	function setUp() {
		$this->e = new \phputil\extenso\Extenso();
	}
	
	function test_usa_formato_de_moeda_por_default() {
		$r = $this->e->extenso( 1001 );
		$this->assertEquals( 'mil e um reais', $r );
	}
	
	function test_moeda_com_valor_inteiro() {
		$r = $this->e->extenso( 1001, Extenso::MOEDA );
		$this->assertEquals( 'mil e um reais', $r );
	}
	
	function test_moeda_com_centavos() {
		$r = $this->e->extenso( 1001.1, Extenso::MOEDA );
		$this->assertEquals( 'mil e um reais e dez centavos', $r );
		$r = $this->e->extenso( 1001.9, Extenso::MOEDA );
		$this->assertEquals( 'mil e um reais e noventa centavos', $r );		
		$r = $this->e->extenso( 1001.01, Extenso::MOEDA );
		$this->assertEquals( 'mil e um reais e um centavo', $r );
		$r = $this->e->extenso( 1001.99, Extenso::MOEDA );
		$this->assertEquals( 'mil e um reais e noventa e nove centavos', $r );		
	}
	
	function test_moeda_com_milesimos() {
		$r = $this->e->extenso( 1001.001, Extenso::MOEDA );
		$this->assertEquals( 'mil e um reais e um milésimo', $r );
		$r = $this->e->extenso( 1001.101, Extenso::MOEDA );
		$this->assertEquals( 'mil e um reais e cento e um milésimos', $r );
		$r = $this->e->extenso( 1001.999, Extenso::MOEDA );
		$this->assertEquals( 'mil e um reais e novecentos e noventa e nove milésimos', $r );	
	}
	
	function test_milhoes() {
		$r = $this->e->extenso( 4025800.99, Extenso::MOEDA );
		$this->assertEquals( 'quatro milhões, vinte e cinco mil e oitocentos reais e noventa e nove centavos', $r );
		$r = $this->e->extenso( 4025800.909, Extenso::MOEDA );
		$this->assertEquals( 'quatro milhões, vinte e cinco mil e oitocentos reais e novecentos e nove milésimos', $r );
	}
	
	function test_vigesilhoes() {
		$r = $this->e->extenso( '9000000000000000000000000000000000000000000000000000000000000001.99', Extenso::MOEDA );
		$this->assertEquals( 'nove vigesilhões e um reais e noventa e nove centavos', $r );
	}
	
	function test_numero_masculino() {
		$r = $this->e->extenso( 1001, Extenso::NUMERO_MASCULINO );
		$this->assertEquals( 'mil e um', $r );
	}
	
	function test_numero_feminino() {
		$r = $this->e->extenso( 1001, Extenso::NUMERO_FEMININO );
		$this->assertEquals( 'mil e uma', $r );
	}
	
}

?>