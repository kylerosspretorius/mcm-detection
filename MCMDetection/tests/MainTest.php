<?php
/**
 * Created by PhpStorm.
 * User: kylepretorius
 * Date: 29/01/2018
 * Time: 10:58
 */

use PHPUnit\Framework\TestCase;


class MainTest extends TestCase {

    public function testCanBeCreatedFromValidEmail() {

        $this->assertInstanceOf(
            Main::class,
            Main::fromString('user@example.com')
        );

    }

    public function testCannotBeCreatedFromInvalidEmailAddress()
    {
        $this->expectException(InvalidArgumentException::class);

        Main::fromString('invalid');
    }

    public function testCanBeUsedAsString()
    {
        $this->assertEquals(
            'user@example.com',
            Main::fromString('user@example.com')
        );
    }



}