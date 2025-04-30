<?php
require_once 'vendor/autoload.php';

use \phputil\extenso\Extenso;
use function \phputil\extenso\{extenso, moeda, feminino, masculino};

describe( 'Extenso', function() {

    $e = null;

    beforeAll( function() {
        $this->e = new Extenso();
    } );

    afterAll( function() {
        $this->e = null;
    } );


	it( 'usa_formato_de_moeda_por_default', function() {
		$r = $this->e->extenso( 1001 );
		expect( $r )->toBe( 'mil e um reais' );
	} );

	it( 'moeda_com_valor_inteiro', function() {
		$r = $this->e->extenso( 1001, Extenso::MOEDA );
		expect( $r )->toBe( 'mil e um reais' );
	} );

	it( 'moeda_com_centavos', function() {
		$r = $this->e->extenso( 1001.1, Extenso::MOEDA );
		expect( $r )->toBe( 'mil e um reais e dez centavos' );
		$r = $this->e->extenso( 1001.9, Extenso::MOEDA );
		expect( $r )->toBe( 'mil e um reais e noventa centavos' );
		$r = $this->e->extenso( 1001.01, Extenso::MOEDA );
		expect( $r )->toBe( 'mil e um reais e um centavo' );
		$r = $this->e->extenso( 1001.99, Extenso::MOEDA );
		expect( $r )->toBe( 'mil e um reais e noventa e nove centavos' );
	} );

	it( 'moeda_com_milesimos', function() {
		$r = $this->e->extenso( 1001.001, Extenso::MOEDA );
		expect( $r )->toBe( 'mil e um reais e um milésimo' );
		$r = $this->e->extenso( 1001.101, Extenso::MOEDA );
		expect( $r )->toBe( 'mil e um reais e cento e um milésimos' );
		$r = $this->e->extenso( 1001.999, Extenso::MOEDA );
		expect( $r )->toBe( 'mil e um reais e novecentos e noventa e nove milésimos' );
	} );

	it( 'milhares', function() {
		$r = $this->e->extenso( 961637, Extenso::NUMERO_MASCULINO );
		expect( $r )->toBe( 'novecentos e sessenta e um mil seiscentos e trinta e sete' );

		$r = $this->e->extenso( 499999.00, Extenso::MOEDA );
		expect( $r )->toBe( 'quatrocentos e noventa e nove mil novecentos e noventa e nove reais' );
		$r = $this->e->extenso( 499999.00, Extenso::NUMERO_MASCULINO );
		expect( $r )->toBe( 'quatrocentos e noventa e nove mil novecentos e noventa e nove' );

		$r = $this->e->extenso( 499999.99, Extenso::MOEDA );
		expect( $r )->toBe( 'quatrocentos e noventa e nove mil novecentos e noventa e nove reais e noventa e nove centavos' );
		$r = $this->e->extenso( 499999.99, Extenso::NUMERO_MASCULINO );
		expect( $r )->toBe( 'quatrocentos e noventa e nove mil novecentos e noventa e nove e noventa e nove centésimos' );
	} );

	it( 'milhoes', function() {
		$r = $this->e->extenso( 4025800.99, Extenso::MOEDA );
		expect( $r )->toBe( 'quatro milhões vinte e cinco mil oitocentos reais e noventa e nove centavos' );
		$r = $this->e->extenso( 4025800.909, Extenso::MOEDA );
		expect( $r )->toBe( 'quatro milhões vinte e cinco mil oitocentos reais e novecentos e nove milésimos' );
	} );

	it( 'bilhoes', function() {
		$r = $this->e->extenso( 4425963737, Extenso::NUMERO_MASCULINO );
		expect( $r )->toBe( 'quatro bilhões quatrocentos e vinte e cinco milhões novecentos e sessenta e três mil setecentos e trinta e sete' );
	} );

	it( 'vigesilhoes', function() {
		$r = $this->e->extenso( '9000000000000000000000000000000000000000000000000000000000000001.99', Extenso::MOEDA );
		expect( $r )->toBe( 'nove vigesilhões e um reais e noventa e nove centavos' );
	} );

	it( 'numero_masculino', function() {
		$r = $this->e->extenso( 1001, Extenso::NUMERO_MASCULINO );
		expect( $r )->toBe( 'mil e um' );
	} );

	it( 'numero_feminino', function() {
		$r = $this->e->extenso( 1001, Extenso::NUMERO_FEMININO );
		expect( $r )->toBe( 'mil e uma' );
	} );

	it( 'funcao_masculino', function() {
		$r = $this->e->extenso( 1001, Extenso::NUMERO_MASCULINO );
		$rf = masculino( 1001 );
		expect( $r )->toBe( 'mil e um' );
		expect( $rf )->toBe( $r );
	} );

	it( 'funcao_feminino', function() {
		$r = $this->e->extenso( 1001, Extenso::NUMERO_FEMININO );
		$rf = feminino( 1001 );
		expect( $r )->toBe( 'mil e uma' );
		expect( $rf )->toBe( $r );
	} );

	it( 'funcao_moeda', function() {
		$r = $this->e->extenso( 1001, Extenso::MOEDA );
		$rf = moeda( 1001 );
		expect( $r )->toBe( 'mil e um reais' );
		expect( $rf )->toBe( $r );
	} );

	it( 'funcao_extenso', function() {
		$r = $this->e->extenso( 1001 );
		$rf = extenso( 1001 );
		expect( $r )->toBe( 'mil e um reais' );
		expect( $rf )->toBe( $r );
	} );

	it( 'funcao_extenso_com_argumento', function() {
		$estilo = Extenso::NUMERO_FEMININO;
		$r = $this->e->extenso( 1001, $estilo );
		$rf = extenso( 1001, $estilo );
		expect( $r )->toBe( 'mil e uma' );
		expect( $rf )->toBe( $r );
	} );

} );