# X-Clacks-Overhead

[![Build Status](https://travis-ci.org/heiglandreas/X-Clacks-Overhead.svg?branch=master)](https://travis-ci.org/heiglandreas/X-Clacks-Overhead)

As described in http://www.gnuterrypratchett.com

## Installation

```bash
composer require org_heigl/clacks-middleware
```

## Usage

### PSR-7

```php

use Org_Heigl\Middleware\Clacks\Clacks;

$clacks = new Clacks();
// add $clacks to your middleware-stack
```

When someone sends a request that already contains an ```X-Clacks-Overhead``` header,
that header is returned.

And when you want to send a different name, you can set that on the constructor
like this:

```php

use Org_Heigl\Middleware\Clacks\Clacks;

$clacks = new Clacks('Jane Doe');
// add $clacks to your middleware-stack
```

### PSR-15

If you are using a PSR15 based stack you can use the `ClacksMiddleware`-Class instead like this:

```php
use Org_Heigl\Middleware\Clacks\ClacksMiddleware;

$clacks = new ClacksMiddleware();
// Add $clacks to your middleware-stack
```

### Adding $clacks to the middleware

#### Slim 4

```php
use Slim\Factory\AppFactory;
use Org_Heigl\Middleware\Clacks\ClacksMiddleware;

$app = AppFactory::create();
$app->add(new ClacksMiddleware());
$app->run();
```

#### Slim 3

```php
use \Slim\App;
use Org_Heigl\Middleware\Clacks\Clacks;

$app = new App();

$app->add(new Clacks());

$app->get('/', function ($request, $response, $args) {
	$response->getBody()->write(' Hello ');

	return $response;
});

$app->run();
```

#### Mezzio

```php
use Laminas\Diactoros\ResponseFactory;
use Laminas\Diactoros\ServerRequestFactory;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use Laminas\HttpHandlerRunner\RequestHandlerRunner;
use Laminas\Stratigility\MiddlewarePipe;
use Org_Heigl\Middleware\Clacks\ClacksMiddleware;
use function Laminas\Stratigility\middleware;

$app = new MiddlewarePipe();

// Landing page
$app->pipe(middleware(new ClacksMiddleware()));

$server = new RequestHandlerRunner(
    $app,
    new SapiEmitter(),
    static function () {
        return ServerRequestFactory::fromGlobals();
    },
    static function (\Throwable $e) {
        $response = (new ResponseFactory())->createResponse(500);
        $response->getBody()->write(sprintf(
            'An error occurred: %s',
            $e->getMessage
        ));
        return $response;
    }
);

$server->run();
```
