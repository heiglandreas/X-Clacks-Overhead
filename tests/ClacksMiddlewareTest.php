<?php
/*
 * Copyright (c) Andreas Heigl<andreas@heigl.org
 *
 * Licensed under the MIT License. See LICENSE.md file in the project root
 * for full license information.
 */

namespace Org_HeiglTest\Middleware\Clacks;

use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\ServerRequest;
use Org_Heigl\Middleware\Clacks\ClacksMiddleware;
use Prophecy\Argument;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use PHPUnit\Framework\TestCase;
use Mockery as M;

class ClacksMiddlewareTest extends TestCase
{
    public function testThatInvocationResultsInXClacksHeader()
    {
        $middleware = new ClacksMiddleware();

        $request  = new ServerRequest('GET', 'http://localhost');
        $response = new Response();

        $handler = M::mock(RequestHandlerInterface::class);
        $handler->shouldReceive('handle')->andReturn($response);

        $response = $middleware->process($request, $handler);

        $this->assertEquals(['GNU Terry Pratchett'], $response->getHeader('X-Clacks-Overhead'));
    }

    public function testThatInvocationWithXClacksResultsInSameName()
    {
        $middleware = new ClacksMiddleware();

        $request  = new ServerRequest('GET', 'http://localhost', ['X-Clacks-Overhead' => ['GNU Foo Bar']]);
        $response = new Response();

        $handler = M::mock(RequestHandlerInterface::class);
        $handler->shouldReceive('handle')->andReturn($response);

        $response = $middleware->process($request, $handler);

        $this->assertEquals(['GNU Foo Bar'], $response->getHeader('X-Clacks-Overhead'));
    }
}
