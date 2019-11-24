<?php

use frankyso\iPaymu\iPaymu;
use PHPUnit\Framework\TestCase;

/**
 * @author Franky So <frankyso.mail@gmail.com>
 */
final class GeneralTest extends TestCase
{
    protected $apiKey = "VfjU5xL8avjYBiZMPzVAFKMXNp35d0";

    public function testCheckBalance(): void
    {
        $iPaymu = new iPaymu($this->apiKey);
        var_dump($iPaymu->checkBalance());
    }

//    public function testCanBeCreatedFromValidEmailAddress(): void
//    {
//        $this->assertInstanceOf(
//            Email::class,
//            Email::fromString('user@example.com')
//        );
//    }
//
//    public function testCannotBeCreatedFromInvalidEmailAddress(): void
//    {
//        $this->expectException(InvalidArgumentException::class);
//
//        Email::fromString('invalid');
//    }
//
//    public function testCanBeUsedAsString(): void
//    {
//        $this->assertEquals(
//            'user@example.com',
//            Email::fromString('user@example.com')
//        );
//    }
}