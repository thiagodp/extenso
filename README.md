![Packagist Version](https://img.shields.io/packagist/v/phputil/extenso?style=for-the-badge&color=green)
![GitHub License](https://img.shields.io/github/license/thiagodp/extenso?style=for-the-badge&color=green)
![Packagist Downloads](https://img.shields.io/packagist/dt/phputil/extenso?style=for-the-badge&color=green)
![Build](https://github.com/thiagodp/extenso/actions/workflows/ci.yml/badge.svg?style=for-the-badge&color=green)

# extenso

> Conversão de valores por extenso em PHP

- Suporta _números_ até a casa dos vigesilhões.
- Suporta _casas decimais_ até vigesilhões.
- Verificado com testes automatizados.
- Usa [Versionamento Semâtico](http://semver.org/).

## Instalação

Versão para PHP 8.x:
```bash
composer require phputil/extenso
```

Versão para PHP 5.4 até 7.x:
```bash
composer require phputil/extenso@2
```



## Documentação

Estilos aceitos:

 Estilo				| Exemplo | Saída
 -------------------|---------|-----------------
 MOEDA				| 1001    | mil e um reais
 NUMERO_MASCULINO	| 1001    | mil e um
 NUMERO_FEMININO	| 1001    | mil e uma


### Exemplos

Uso com classe `Extenso`:
```php
require_once 'vendor/autoload.php';

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

Uso com funções - versão 2.1 ou posterior:

```php
require_once 'vendor/autoload.php';

use phputil\extenso\extenso;
use phputil\extenso\moeda;
use phputil\extenso\masculino;
use phputil\extenso\feminino;

extenso( 1001 );   // mil e um reais
moeda( 1001 );     // mil e um reais
masculino( 1001 ); // mil e um
feminino( 1001 );  // mil e uma
```


## Veja também

Bibliotecas de código que podem lhe ser úteis:

- [phputil/tdatetime](https://github.com/thiagodp/TDateTime) - Manipulação de datas e horas
- [phputil/json](https://github.com/thiagodp/json) - Manipulação de formato JSON
- [phputil/router](https://github.com/thiagodp/router) - Construção de APIs RESTful como no ExpressJS
- [phputil/rtti](https://github.com/thiagodp/rtti) - Extração de informações de objetos em tempo de execução
- [mais...](https://packagist.org/?query=phputil%2F)

## Licença

LGPL © [Thiago Delgado Pinto](https://github.com/thiagodp)
