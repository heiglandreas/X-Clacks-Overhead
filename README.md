# X-Clacks-Overhead

As described in http://www.gnuterrypratchett.com

## Installation

```bash
composer require org_heigl/clacks-middleware
```

## Usage

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
