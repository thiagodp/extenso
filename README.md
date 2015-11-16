# extenso

Conversão de valores por extenso em PHP

[![Build Status](https://travis-ci.org/thiagodp/extenso.svg?branch=master)](https://travis-ci.org/thiagodp/extenso)

Current [version](http://semver.org/): `0.1` 

### ESTILOS ACEITOS
 
 Estilo			| Exemplo | Saída 
 -----------------------|---------|-----------------
 MOEDA			| 1001    | mil e um reais
 NUMERO_MASCULINO	| 1001    | mil e um
 NUMERO_FEMININO	| 1001    | mil e uma
   

###  EXEMPLOS DE USO
 
 ```php
 $e = new \phputil\extenso\Extenso();
 $e->extenso( 1001 ); // mil e um reais
 $e->extenso( 1001, Extenso::MOEDA ); // mil e um reais
 $e->extenso( 1001, Extenso::NUMERO_MASCULINO ); // mil e um
 $e->extenso( 1001, Extenso::NUMERO_FEMININO ); // mil e uma
 
 $e->extenso( 1001.01 ); // mil e um reais e um centavo
 $e->extenso( 1001.001 ); // mil e um reais e um milésimo
 
 // quatro milhões, vinte e cinco mil e oitocentos reais e noventa e nove centavos
 $e->extenso( 4025800.99 );
 ```
 
### OBSERVAÇÕES
 
 * Suporta números até a casa dos vigesilhões.
 * Suporta casas decimais até vigesilões.
