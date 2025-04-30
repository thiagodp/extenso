<?php
namespace phputil\extenso;

function extenso( $valor, $estilo = 0 ) {
	return ( new Extenso() )->extenso( $valor, $estilo );
}

function moeda( $valor ) {
	return ( new Extenso() )->extenso( $valor, Extenso::MOEDA );
}

function masculino( $valor ) {
	return ( new Extenso() )->extenso( $valor, Extenso::NUMERO_MASCULINO );
}

function feminino( $valor ) {
	return ( new Extenso() )->extenso( $valor, Extenso::NUMERO_FEMININO );
}
?>