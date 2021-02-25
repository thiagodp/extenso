<?php
namespace phputil\extenso;

/**
 *  Fornece o valor por extenso do número fornecido.
 *
 *  	ESTILOS ACEITOS:
 *
 *  	Estilo					Exemplo		Saída
 *  	-----------------------------------------------------
 *  	MOEDA					1001		mil e um reais
 *  	NUMERO_MASCULINO		1001		mil e um
 *  	NUMERO_FEMININO			1001		mil e uma
 *  	-----------------------------------------------------
 *
 *  	EXEMPLOS DE USO:
 *
 *  	$e = new \phputil\extenso\Extenso();
 *
 *  	$e->extenso( 1001 ); // mil e um reais
 *  	$e->extenso( 1001, Extenso::MOEDA ); // mil e um reais
 *  	$e->extenso( 1001, Extenso::NUMERO_MASCULINO ); // mil e um
 * 		$e->extenso( 1001, Extenso::NUMERO_FEMININO ); // mil e uma
 *
 *  	$e->extenso( 1001.01 ); // mil e um reais e um centavo
 *  	$e->extenso( 1001.001 ); // mil e um reais e um milésimo
 *
 *  	// quatro milhões vinte e cinco mil oitocentos reais e noventa e nove centavos
 *		$e->extenso( 4025800.99 );
 *
 *  	OBSERVAÇÕES:
 *  		- Suporta números até a casa dos vigesilhões.
 *  		- Suporta casas decimais até vigesilões.
 *
 *
 *  @author	Thiago Delgado Pinto
 */
class Extenso {

	const MOEDA				= 0;
	const NUMERO_MASCULINO	= 1;
	const NUMERO_FEMININO	= 2;


	function __construct() {

		$this->virgula = 'e'; // 'vírgula' trocado por 'e'
		$this->separador = ''; // ',' -> símbolo de vírgula não deve ser utilizado como separador
		$this->conector = 'e';

		$this->centavoSingular = 'centavo';
		$this->centavoPlural = 'centavos';

		$this->moedaSingular = 'real';
		$this->moedaPlural = 'reais';


		// array 4 x 10
		$this->trioExtensoM = array(
			array( 'zero', 'um', 'dois', 'três', 'quatro', 'cinco', 'seis', 'sete', 'oito', 'nove' ),
            array( 'dez', 'onze', 'doze', 'treze', 'quatorze', 'quinze', 'dezesseis', 'dezessete', 'dezoito', 'dezenove' ),
			array( '', '', 'vinte', 'trinta', 'quarenta', 'cinquenta', 'sessenta', 'setenta', 'oitenta', 'noventa' ),
            array( 'cem', 'cento', 'duzentos', 'trezentos', 'quatrocentos','quinhentos', 'seiscentos', 'setecentos', 'oitocentos', 'novecentos' )
			);

		// array 4 x 10
		$this->trioExtensoF = array(
			array( 'zero', 'uma', 'duas', 'três', 'quatro', 'cinco', 'seis', 'sete', 'oito', 'nove' ),
            array( 'dez', 'onze', 'doze', 'treze', 'quatorze', 'quinze', 'dezesseis', 'dezessete', 'dezoito', 'dezenove' ),
			array( '', '', 'vinte', 'trinta', 'quarenta', 'cinquenta', 'sessenta', 'setenta', 'oitenta', 'noventa' ),
            array( 'cem', 'cento', 'duzentas', 'trezentas', 'quatrocentas','quinhentas', 'seiscentas', 'setecentas', 'oitocentas', 'novecentas' )
			);

		$this->classeExtenso = array(
			'cem', 'mil', 'milh', 'bilh', 'trilh', 'quatrilh', 'quintilh', 'sextilh', 'septilh', 'octilh', 'nonilh',
			'decilh', 'undecilh', 'duodecilh', 'tredecilh', 'quatordecilh', 'quindecilh', 'sexdecilh', 'setedecilh', 'octodecilh', 'novedecilh',
			'vigesilh'
			);

		$this->complementoSingular = 'ão';
		$this->complementoPlural = 'ões';

		// Decimais

		$this->decimais = array( 'déc', 'centés', 'milés', 'milhonés', 'bilhonés', 'trilhonés', 'quatrilhonés', 'quintilhonés',
			'sextilhonés', 'septilhonés', 'octilhonés', 'nonilhonés',
			'decilhonés', 'undecilhonés', 'duodecilhonés', 'tredecilhonés', 'quatordecilhonés', 'quindecilhonés',
			'sexdecilhonés', 'setedecilhonés', 'octodecilhonés', 'novedecilhonés', 'vigesilhonés'
		);

		$this->decimalSufixoSingular = 'imo';
		$this->decimalSufixoPlural = 'imos';
	}


	/**
	 *  Retorna um valor por extenso.
	 *
	 *  @param	double	$valor	Valor a ser retornado por extenso.
	 *  @param	int		$estilo	Estilo do valor por extenso:
	 *  					MOEDA, NUMERO_MASCULINO ou NUMERO_FEMININO.
	 *
	 *  @return string
	 */
	function extenso( $valor = 0.0, $estilo = 0 ) {

		$moeda = self::MOEDA == $estilo;
		$masculino = $moeda || self::NUMERO_MASCULINO == $estilo;

		$texto = $valor . '';

		$ponto = mb_strpos( $texto, '.' );
		$temPonto = $ponto !== false;

		$parteInteira = $temPonto ? mb_substr( $texto, 0, $ponto ) : $texto;
		$parteFracionaria = $temPonto ? mb_substr( $texto, $ponto + 1 ) : '';

		if ( 0 == $parteInteira && $parteFracionaria > 0 ) {
			return $this->sentencaParteFracionaria( $parteFracionaria, $moeda, $masculino );
		}

		$sentenca = $this->sentencaParteInteira( $parteInteira, $moeda, $masculino );

		if ( $temPonto ) {
			$sentenca .= ' ' . ( $moeda ? $this->conector : $this->virgula ) . ' '
				. $this->sentencaParteFracionaria( $parteFracionaria, $moeda, $masculino );
		}
		return $sentenca;
	}

	//
	// PRIVADO
	//

	private function sentencaParteInteira( $valor, $moeda, $masculino ) {

		$texto = (string) $valor;
		$numeroDigitos = mb_strlen( $texto );

		$resto = $numeroDigitos % 3;
		$complemento = 0 === $resto ? 0 : 3 - $resto;

		// Preenche com zero à esquerda para que o número possa ser quebrado em grupos de três
		$ajustado = str_pad( $valor, $numeroDigitos + $complemento, '0', STR_PAD_LEFT ); // ex: '12345' --> '012345'

		// Quebra em grupos de três
		$gruposTres = str_split( $ajustado, 3 );	// ex: '012345' --> [ '012', '345' ]

		$numeroGrupos = count( $gruposTres ); // ex: 1 = centenas, 2 = milhares, 3 = milhões, ...

		if ( 1 === $numeroGrupos && $gruposTres[ 0 ] === '000' ) {
			return $moeda ? 'zero centavo' : 'zero';
		}

		$reverso = array_reverse( $gruposTres );
		$partes = array();
		foreach ( $reverso as $classe => $trio ) {

			if ( '000' === $trio ) { continue; }

			// Corrige o gênero feminino para milhões ou acima
			$masc = $masculino ? true : $classe > 1;

			$extenso = $this->sentencaTrio( $trio, $moeda, $masc, $numeroGrupos );
			$extenso .= $classe > 0 ? ' ' . $this->classeExtenso[ $classe ] : '';
			if ( $classe >= 2 ) {
				$extenso .= $trio !== '001' ? $this->complementoPlural : $this->complementoSingular;
			}

			array_unshift( $partes, $extenso );
		}

		$sentenca = '';

		$cnt = mb_strlen( $valor );
		if ( $cnt >= 3 && '0' === mb_substr( $valor, $cnt - 3, 1 ) ) {
			$sentenca = implode( ' ' . $this->conector . ' ', $partes );
		} else {
			$sentenca = implode( ' ', $partes );
		}

		$sentenca = $this->corrigir( $sentenca, $valor );

		// Moeda
		if ( $moeda ) {
			$sentenca = $this->aplicarMoedaParteInteira( $sentenca, $valor );
		}

		return $sentenca;
	}


	function corrigir( $sentenca, $valor ) {
		$texto = trim( $sentenca );
		if ( $valor >= 1000 && $valor < 2000 ) {
			if ( mb_strpos( $texto, 'uma mil' ) === 0 ) {
				$texto = mb_substr( $texto, 4 ); // Retira o "uma"
			} else if ( mb_strpos( $texto, 'um mil' ) === 0 ) {
				$texto = mb_substr( $texto, 3 ); // Retira o "um"
			}
		}
		return $texto;
	}

	function aplicarMoedaParteInteira( $sentenca, $valor ) {
		if ( 0 == $valor ) {
			return $sentenca . ' ' . $this->centavoSingular;
		} else if ( 1 == $valor ) {
			return $sentenca . ' ' . $this->moedaSingular;
		}
		return $sentenca . ' ' . $this->moedaPlural;
	}


	function sentencaTrio( $trio, $moeda, $masculino, $numeroGrupos ) {

		$extenso = $masculino ? $this->trioExtensoM : $this->trioExtensoF;

		$c = $trio[ 0 ]; // centena
		$d = $trio[ 1 ]; // dezena
		$u = $trio[ 2 ]; // unidade

		$partes = array();

		if ( $trio == '100' ) {
			return $extenso[ 3 ][ 0 ]; // cem
		}

		if ( $c != '0' ) {
			$partes []= $extenso[ 3 ][ $c ]; // cento, duzentos, ...
		}

		if ( '1' == $d ) {
			$partes []= $extenso[ 1 ][ $u ]; // dezenas de 11-19
		} else { // unidades

			if ( $d != '0' ) {  // dezenas
				$partes []= $extenso[ 2 ][ $d ]; // vinte, trinta, ...
			}

			if ( $u != '0' ) { // unidades
				$partes []= $extenso[ 0 ][ $u ]; // dois, três
			}
		}

		$sentenca = implode( ' ' . $this->conector . ' ', $partes );

		return $sentenca;
	}


	function sentencaParteFracionaria( $valor, $moeda, $masculino ) {

		$fracao = $valor;
		if ( $moeda ) {

			if ( mb_strlen( $fracao ) <= 2 ) {

				$fracao = str_pad( $fracao, 2, '0' );
				$fracao = mb_substr( $fracao, 0, 2 );

				if ( 0 == $fracao ) {
					return ''; // nenhuma
				}

				return $this->sentencaParteInteira( (int) $fracao, false, true )
					. $this->adicionarParteFracionaria( $valor, $fracao );

			}
		}

		return $this->sentencaParteInteira( (int) $fracao, false, true )
			. ' ' . $this->complementoDecimais( $fracao )
			;
	}



	function complementoDecimais( $valor ) {
		$texto = $valor . '';
		$numeroDigitos = mb_strlen( $texto );
		return $this->decimais[ $numeroDigitos - 1 ]
			. ( 1 == $valor ? $this->decimalSufixoSingular : $this->decimalSufixoPlural );
	}



	function adicionarParteFracionaria( $valor, $parteFracionaria ) {
		if ( 0 == $parteFracionaria ) {
			return ''; // sem acréscimos
		}

		if ( 1 == $parteFracionaria ) {
			return ' ' . $this->centavoSingular;
		}

		return ' ' . $this->centavoPlural;
	}

}

?>