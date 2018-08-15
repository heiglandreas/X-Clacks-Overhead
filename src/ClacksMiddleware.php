<?php

/*
 * Copyright (c) Andreas Heigl<andreas@heigl.org
 * 
 * Licensed under the MIT License. See LICENSE.md file in the project root
 * for full license information.
 */

namespace Org_Heigl\Middleware\Clacks;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ClacksMiddleware implements MiddlewareInterface
{
    private $name;

    public function __construct($name = 'Terry Pratchett')
    {
        $this->name = $name;
    }

    /**
     * Process an incoming server request and return a response, optionally delegating
     * response creation to a handler.
     */
    public function process(
        ServerRequestInterface $request,
        RequestHandlerInterface $handler
    ): ResponseInterface {

        $clacker = 'GNU ' . $this->name;
        if ($request->hasHeader('X-Clacks-Overhead')) {
            $clacker = $request->getHeader('X-Clacks-Overhead')[0];
        }

        $response = $handler->handle($request);

        return $response->withHeader('X-Clacks-Overhead', $clacker);
    }
}
