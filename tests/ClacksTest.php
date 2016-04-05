<?php
/**
 * Copyright (c) 2016-2016} Andreas Heigl<andreas@heigl.org>
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @author    Andreas Heigl<andreas@heigl.org>
 * @copyright 2016-2016 Andreas Heigl
 * @license   http://www.opensource.org/licenses/mit-license.php MIT-License
 * @version   0.0
 * @since     05.04.2016
 * @link      http://github.com/heiglandreas/org.heigl.ClacksMiddleware
 */

namespace Org_HeiglTest\Middleware\Clacks;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Org_Heigl\Middleware\Clacks\Clacks;

class ClacksTest extends \PHPUnit_Framework_TestCase
{
    public function testThatInvocationResultsInXClacksHeader()
    {
        $middleware = new Clacks();

        $request  = new Request('GET', 'http://localhost');
        $response = new Response();
        
        $response = $middleware($request, $response, function ($request, $response) {
            return $response;
        });
        $this->assertEquals(['GNU Terry Pratchett'], $response->getHeader('X-Clacks-Overhead'));
    }

    public function testThatInvocationWithXClacksResultsInSameName()
    {
        $middleware = new Clacks();

        $request  = new Request('GET', 'http://localhost', ['X-Clacks-Overhead' => ['GNU Foo Bar']]);
        $response = new Response();

        $response = $middleware($request, $response, function ($request, $response) {
            return $response;
        });
        $this->assertEquals(['GNU Foo Bar'], $response->getHeader('X-Clacks-Overhead'));
    }
}
