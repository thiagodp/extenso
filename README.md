[![Build Status](https://travis-ci.org/thiagodp/extenso.svg?branch=master&style=flat)](https://travis-ci.org/thiagodp/extenso)
[![Version](https://poser.pugx.org/phputil/extenso/v?style=flat-square)](https://packagist.org/packages/phputil/extenso)
[![Downloads](https://poser.pugx.org/phputil/extenso/downloads?style=flat-square)](https://packagist.org/packages/phputil/extenso)


# extenso

> Conversão de valores por extenso em PHP (>= 5.4)

- Suporta _números_ até a casa dos vigesilhões.
- Suporta _casas decimais_ até vigesilhões.
- Verificado com testes automatizados.
- Usa [Versionamento Semâtico](http://semver.org/).

## Instalação

```bash
composer require phputil/extenso
```

## Documentação

Estilos aceitos:

 Estilo				| Exemplo | Saída
 -------------------|---------|-----------------
 MOEDA				| 1001    | mil e um reais
 NUMERO_MASCULINO	| 1001    | mil e um
 NUMERO_FEMININO	| 1001    | mil e uma


### Exemplos

```php
use phputil\extenso\Extenso;

$e = new Extenso();
$e->extenso( 1001 ); // mil e um reais
$e->extenso( 1001, Extenso::MOEDA ); // mil e um reais
$e->extenso( 1001, Extenso::NUMERO_MASCULINO ); // mil e um
$e->extenso( 1001, Extenso::NUMERO_FEMININO ); // mil e uma

$e->extenso( 1001.01 ); // mil e um reais e um centavo
$e->extenso( 1001.001 ); // mil e um reais e um milésimo

// quatro milhões vinte e cinco mil oitocentos reais e noventa e nove centavos
$e->extenso( 4025800.99 );
```

## Outras

Outras bibliotecas de código que podem ser úteis:

- [phputil/tdatetime](https://github.com/thiagodp/TDateTime)
- [phputil/json](https://github.com/thiagodp/json)
- [phputil/router](https://github.com/thiagodp/router)
- [phputil/rtti](https://github.com/thiagodp/rtti)
- [mais...](https://packagist.org/?query=phputil%2F)

## Licença

LGPL © [Thiago Delgado Pinto](https://github.com/thiagodp)
