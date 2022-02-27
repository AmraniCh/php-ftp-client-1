<?php

namespace Lazzard\FtpClient\Tests\Integration;

use PHPUnit\Framework\TestCase;
use Lazzard\FtpClient\Exception\WrapperException;
use Lazzard\FtpClient\FtpWrapper;

class FtpWrapperTest extends TestCase
{
    public function testConstruct() : void
    {
        $factory = new FtpConnectionFactory();
        $wrapper = new FtpWrapper($factory->create());
        $this->assertInstanceOf(FtpWrapper::class, $wrapper);
    }

    public function testGetErrorMessage() : void
    {
        $factory = new FtpConnectionFactory();
        $wrapper = new FtpWrapper($factory->create());
        $wrapper->connect('foo.bar.com');
        $this->assertIsString($wrapper->getErrorMessage());
    }

    public function test__callWithExistFtpFunction() : void
    {
        $factory = new FtpConnectionFactory();
        $wrapper = new FtpWrapper($factory->create());
        $this->assertIsResource($wrapper->connect(HOST));
    }

    public function test__callWithNonExistFtpFunction() : void
    {
        $factory = new FtpConnectionFactory();
        $wrapper = new FtpWrapper($factory->create());
        $this->expectException(WrapperException::class);
        $wrapper->function();
    }
}
