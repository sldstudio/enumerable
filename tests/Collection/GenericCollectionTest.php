<?php

namespace Tests\Collection;

use Tests\Collection\Concretes\TestEntity;
use Tests\Collection\Concretes\TestEntityCollection;
use PHPUnit\Framework\TestCase;
use Solid\Foundation\Exceptions\UnexpectedValueException;

class GenericCollectionTest extends TestCase
{
    public function testExceptionOnIncorrectValuePassedToConstuctor()
    {
        static::expectException(UnexpectedValueException::class);
        $collection = new TestEntityCollection(['test']);
    }

    public function testExceptionOnIncorrectValuePassedToPush()
    {
        static::expectException(UnexpectedValueException::class);
        $collection = new TestEntityCollection();
        $collection->push('test');
    }

    public function testExceptionOnIncorrectValuePassedToPut()
    {
        static::expectException(UnexpectedValueException::class);
        $collection = new TestEntityCollection();
        $collection->put('key', 'test');
    }

    public function testExceptionOnIncorrectValuePassedToAdd()
    {
        static::expectException(UnexpectedValueException::class);
        $collection = new TestEntityCollection();
        $collection->add('test');
    }

    public function testExceptionOnIncorrectValuePassed()
    {
        static::expectException(UnexpectedValueException::class);
        $collection = new TestEntityCollection();
        $collection[] = 'test';
    }
}