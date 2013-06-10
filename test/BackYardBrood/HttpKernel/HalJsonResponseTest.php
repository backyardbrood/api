<?php
/**
 * Copyright (c) 2013 Adam L. Englander
 *
 * Permission is hereby granted, free of charge, to any person obtaining a
 * copy of this software and associated documentation files (the "Software"),
 * to deal in the Software without restriction, including without limitation
 * the rights to use, copy, modify, merge, publish, distribute, sublicense,
 * and/or sell copies of the Software, and to permit persons to whom the Software
 * is furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED,
 * INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A
 * PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
 * HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF
 * CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE
 * OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

namespace BackYardBrood\Test\HttpKernel;

use BackYardBrood\HttpKernel\HalJsonResponse;

/**
 * @author Adam L. Englander <adam.l.englander@coupla.co>
 */

class HalJsonResponseTest extends \PHPUnit_Framework_TestCase
{

    public function testConstructNullDataSetsEmptyStringContent()
    {
        $response = new HalJsonResponse();
        $this->assertEquals('', $response->getContent());
    }

    public function testConstructArrayDataSetsContentAsJsonString()
    {
        $data = array('x' => 1);
        $expected = json_encode($data);

        $response = new HalJsonResponse($data);
        $actual = $response->getContent();
        $this->assertEquals($expected, $actual);
    }

    public function testConstructNoContentTypeDefaultsToApplicationHalJson()
    {
        $expected = 'application/hal+json';
        $response = new HalJsonResponse();
        $actual = $response->headers->get('Content-Type');
        $this->assertEquals($expected, $actual);
    }

    public function testConstructWithContentTypeUsesContentType()
    {
        $expected = 'other';
        $response = new HalJsonResponse(null, 200, array('Content-Type' => 'other'));
        $actual = $response->headers->get('Content-Type');
        $this->assertEquals($expected, $actual);
    }

    public function testConstructAcceptsHeaderValue()
    {
        $expected = 'value';
        $response = new HalJsonResponse(null, 200, array('header' => $expected));
        $actual = $response->headers->get('header');
        $this->assertEquals($expected, $actual);
    }

    public function testConstructNullCodeDefaultsTo200()
    {
        $response = new HalJsonResponse();
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testConstructUsesCode()
    {
        $response = new HalJsonResponse(null, 201);
        $this->assertEquals(201, $response->getStatusCode());
    }
}
