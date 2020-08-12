<?php
/*
 * Copyright (c) Andreas Heigl<andreas@heigl.org
 *
 * Licensed under the MIT License. See LICENSE.md file in the project root
 * for full license information.
 */

namespace Org_Heigl\Middleware\Clacks;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class Clacks
{
    protected $name;

    /**
     * Set the name of the person
     *
     * @param string $name
     */
    public function __construct($name = "Terry Pratchett")
    {
        $this->name = $name;
    }

    /**
     * Example middleware invokable class
     *
     * @param  \Psr\Http\Message\RequestInterface  $request  PSR7 request
     * @param  \Psr\Http\Message\ResponseInterface $response PSR7 response
     * @param  callable                            $next     Next middleware
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke(
        RequestInterface $request,
        ResponseInterface $response,
        callable $next
    ) {
        $clacker = 'GNU ' . $this->name;
        if ($request->hasHeader('X-Clacks-Overhead')) {
            $clacker = $request->getHeader('X-Clacks-Overhead')[0];
        }

        $response = $response->withHeader('X-Clacks-Overhead', $clacker);
        return $next($request, $response);
    }

}