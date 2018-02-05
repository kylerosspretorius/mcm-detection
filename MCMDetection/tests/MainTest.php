<?php
/**
 * Created by PhpStorm.
 * User: kylepretorius
 * Date: 29/01/2018
 * Time: 10:58
 */

namespace MCM\MCMDetection\Tests;

use PHPUnit\Framework\TestCase;

use MCM\MCMDetection\MnoDetectMain;

class MainTest extends TestCase {

//    public function testCanBeCreatedFromValidEmail() {
//
//        $this->assertInstanceOf(
//            Main::class,
//            Main::fromString('user@example.com')
//        );
//
//    }
//
//    public function testCannotBeCreatedFromInvalidEmailAddress()
//    {
//        $this->expectException(InvalidArgumentException::class);
//
//        Main::fromString('invalid');
//    }
//
    public function testMustMatch()
    {

        $hyvedetect = new MnoDetectMain();
        $testcase1  = $hyvedetect->testConnection();

        var_dump($testcase1);

//        $this->assertEquals(
//            'working!',
//            $testcase1
//        );
    }



}