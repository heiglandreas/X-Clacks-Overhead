<?php
/*
 * Copyright (c) Andreas Heigl<andreas@heigl.org
 *
 * Licensed under the MIT License. See LICENSE.md file in the project root
 * for full license information.
 */

namespace Org_HeiglTest\Middleware\Clacks;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Org_Heigl\Middleware\Clacks\Clacks;
use PHPUnit\Framework\TestCase;

class ClacksTest extends TestCase
{
    public function testThatInvocationResultsInXClacksHeader()
    {
        $middleware = new Clacks();

        $request  = new Request('GET', 'http://localhost');
        $response = new Response();
        
        $response = $middleware($request, $response, function ($request, $response) {
            return $response;
        });
        self::assertEquals(['GNU Terry Pratchett'], $response->getHeader('X-Clacks-Overhead'));
    }

    public function testThatInvocationWithXClacksResultsInSameName()
    {
        $middleware = new Clacks();

        $request  = new Request('GET', 'http://localhost', ['X-Clacks-Overhead' => ['GNU Foo Bar']]);
        $response = new Response();

        $response = $middleware($request, $response, function ($request, $response) {
            return $response;
        });
        self::assertEquals(['GNU Foo Bar'], $response->getHeader('X-Clacks-Overhead'));
    }
}
