<?php

namespace Tests\Framework\Container;

use Framework\Container\SimpleContainer as Container;
use Tests\TestCase;

class SimpleContainerTest extends TestCase
{

    private Container $container;

    public function testMakeWithoutConstructor(): void
    {
        $object = $this->container->make(ClassWithoutConstructorStub::class);

        $this->assertInstanceOf(ClassWithoutConstructorStub::class, $object);
    }

    public function testMakeWithoutParams(): void
    {
        $object = $this->container->make(ClassWithoutParamsStub::class);

        $this->assertInstanceOf(ClassWithoutParamsStub::class, $object);
    }

    public function testMakeWithSingleParam(): void
    {
        $object = $this->container->make(ClassWithParam::class);

        $this->assertInstanceOf(ClassWithParam::class, $object);
    }

    public function testMakeWithManyParams(): void
    {
        $this->container->singleton(ClassWithoutParamsStub::class);

        $object = $this->container->make(ClassWithManyParams::class);
        
        $this->assertInstanceOf(ClassWithManyParams::class, $object);
        
        $this->assertSame($object->param1, $object->param3);
        $this->assertNotSame($object->param2, $object->param4);
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->container = new Container();
    }

}

class ClassWithoutConstructorStub
{

}

class ClassWithoutParamsStub
{
    public function __construct()
    {
    }
}

class ClassWithParam
{
    public function __construct(ClassWithoutParamsStub $param1)
    {
    }
}

class ClassWithManyParams
{
    public function __construct(
        ClassWithoutParamsStub $param1,
        ClassWithParam $param2,
        ClassWithoutParamsStub $param3,
        ClassWithParam $param4,
    ) {
        $this->param1 = $param1;
        $this->param2 = $param2;
        $this->param3 = $param3;
        $this->param4 = $param4;
    }
}
