# extenso

Conversão de valores por extenso em PHP (>= 5.6)

[![Build Status](https://travis-ci.org/thiagodp/extenso.svg?branch=master)](https://travis-ci.org/thiagodp/extenso)

Usamos [versionamento semâtico](http://semver.org/). Veja nossos [releases](https://github.com/thiagodp/extenso/releases).

## Estilos aceitos

 Estilo				| Exemplo | Saída
 -------------------|---------|-----------------
 MOEDA				| 1001    | mil e um reais
 NUMERO_MASCULINO	| 1001    | mil e um
 NUMERO_FEMININO	| 1001    | mil e uma


## Exemplos

```php
$e = new \phputil\extenso\Extenso();
$e->extenso( 1001 ); // mil e um reais
$e->extenso( 1001, Extenso::MOEDA ); // mil e um reais
$e->extenso( 1001, Extenso::NUMERO_MASCULINO ); // mil e um
$e->extenso( 1001, Extenso::NUMERO_FEMININO ); // mil e uma

$e->extenso( 1001.01 ); // mil e um reais e um centavo
$e->extenso( 1001.001 ); // mil e um reais e um milésimo

// quatro milhões vinte e cinco mil oitocentos reais e noventa e nove centavos
$e->extenso( 4025800.99 );
```

## OBSERVAÇÕES

 * Suporta _números_ até a casa dos vigesilhões.
 * Suporta _casas decimais_ até vigesilhões.

## Licença

LGPL © [Thiago Delgado Pinto](https://github.com/thiagodp)