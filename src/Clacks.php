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