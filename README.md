# skyhub-client
Client para consumo da API SkyHub

[![Build Status](https://travis-ci.org/dilowagner/skyhub-client.svg?branch=master)](https://travis-ci.org/dilowagner/skyhub-client.svg?branch=master)
[![Packagist](https://img.shields.io/packagist/v/dw/skyhub-client.svg)](https://github.com/dilowagner/skyhub-client)

> ### Requisitos

- PHP 7.1+
- Autoloader compatível com a PSR-4

> ### Funcionalidades

- [X] Atributos
- [X] Categorias
- [X] Fretes
- [X] Pedidos
- [X] Postagens
- [X] Produtos
- [X] Perguntas
- [X] Filas
- [X] Sistemas de Vendas
- [X] Status do Pedido
- [X] Tipo de Status
- [X] Sincronizacao dos Erros
- [X] Variacoes

> ### Dependências

- PHP-DI: 6.0.2

> ### Instalação

Para instalar a biblioteca basta adicioná-la via [composer](https://getcomposer.org/download/)

```composer
composer require dw/skyhub-client
```

Ou via composer.json

```json
{
    "dw/skyhub-client": "1.*"
}
```

> ### Testes

Podemos usar o composer para rodar os testes:

```composer
composer test
```
ou utilizando o .phar

```composer
php composer.phar test
```

> ### Utilização

Neste [link](https://skyhub.gelato.io/docs/versions/1.0/sobre-a-api-skyhub) você encontra mais informaçoes de como utilizar a API v1.0

Apos realizar o cadastro na plataforma, você receberá a API-KEY e o ACCOUNT-MANAGER-KEY para realizar a integracao.

A seguir um pequeno exemplo de como criar/enviar um Produto usando esta biblioteca.

```php
<?php
declare(strict_types=1);

// Considero que já existe um autoloader compatível com a PSR-4 registrado

use DW\SkyHub\SkyHubClient;

$client = new SkyHubClient("meu-email@exemplo.com", "api-key", "account-manager-key");

$data = [
    'sku' => 'foo',
    'name' => 'foo',
    'description' => 'foo',
    'status' => 'enabled',
    'qty' => 0,
    'price' => 99.99,
    'promotional_price' => 0,
    'cost' => 0,
    'weight' => 0,
    'height' => 0,
    'width' => 0,
    'length' => 0,
    'brand' => 'foo',
    'ean' => 'foo',
    'nbm' => 'foo',
    'categories' => [
        0 => [
        'code' => 'foo',
        'name' => 'foo',
        ],
    ],
    'images' => [
        0 => 'http://url.produto.com/img.jpg'
    ],
    'specifications' => [
        0 => [
            'key' => 'foo',
            'value' => 'foo',
        ],
    ],
    'variations' => [
        0 => [
            'sku' => 'foo',
            'qty' => 0,
            'ean' => 'foo',
            'images' => [
                0 => 'http://url.produto.com/img.jpg'
            ],
            'specifications' => [
                0 => [
                    'key' => 'foo',
                    'value' => 'foo',
                ],
            ],
        ],
    ],
    'variation_attributes' => [
        0 => 'foo',
        1 => 'foo',
        2 => 'foo',
    ],
];

$response = $client->product->create($data);

var_dump($response);
```

> ### Contribua!

Quer contribuir? [clique aqui](https://github.com/dilowagner/skyhub-client/blob/master/CONTRIBUTING.md)

> ### Licença

Esta biblioteca segue os termos de uso da [MIT](https://github.com/dilowagner/skyhub-client/blob/master/LICENSE)
