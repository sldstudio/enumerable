<?php

namespace Tests;

use DateTime;
use DateTimeInterface;
use Exception;
use PHPUnit\Framework\TestCase;
use Solid\Foundation\Adapters\DateAdapter;

class DateAdapterTest extends TestCase
{
    public function testTimestamp()
    {
        self::assertInstanceOf(DateTimeInterface::class, DateAdapter::asCarbon(time()));
    }

    public function testDate()
    {
        self::assertInstanceOf(DateTimeInterface::class, DateAdapter::asCarbon(new DateTime()));
    }

    public function testString()
    {
        self::assertInstanceOf(DateTimeInterface::class, DateAdapter::asCarbon('2021-01-01 00:00'));
    }

    public function testFailedToParse()
    {
        $this->expectException(Exception::class);
        DateAdapter::asCarbon('abra-kadabra');
    }
}