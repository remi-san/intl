<?php

namespace RemiSan\Intl\Test;

use RemiSan\Intl\TranslatableResource;

class ResourceTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
    }

    public function tearDown()
    {
        \Mockery::close();
    }

    /**
     * @test
     */
    public function test()
    {
        $key = 'key';
        $params = [
            'n' => 'v'
        ];
        $resource = new TranslatableResource($key, $params);

        $this->assertEquals($key, $resource->getKey());
        $this->assertEquals($params, $resource->getParameters());
    }
}
