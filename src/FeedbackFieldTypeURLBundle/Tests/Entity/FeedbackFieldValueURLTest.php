<?php

namespace FeedbackFieldTypeURLBundle\Tests\Entity;

use FeedbackFieldBundle\Tests\BaseTest;
use FeedbackFieldTypeURLBundle\Entity\FeedbackFieldValueURL;


/**
 *  @license 3-clause BSD
 *  @link https://github.com/FeedbackField/FeedbackField-Core
 */
class FeedbackFieldValueURLTest extends BaseTest {


    function dataForTestSetValueFromAPI1ReturnTrue() {
        return array(
            array('http://www.google.com','http','www.google.com',80,null,null,null,null,null),
            array('https://www.google.com','https','www.google.com',443,null,null,null,null,null),
            array('https://www.google.com:8080','https','www.google.com',8080,null,null,null,null,null),
        );
    }

    /**
     * @dataProvider dataForTestSetValueFromAPI1ReturnTrue
     */
    function testSetValueFromAPI1ReturnTrue($in, $scheme, $host, $port, $user, $pass, $path, $query, $fragment) {
        $obj = new FeedbackFieldValueURL();
        $this->assertTrue($obj->setValueFromAPI1($in));
        $this->assertEquals($scheme,  $obj->getValueScheme());
        $this->assertEquals($host,  $obj->getValueHost());
        $this->assertEquals($port,  $obj->getValuePort());
        $this->assertEquals($user,  $obj->getValueUser());
        $this->assertEquals($pass,  $obj->getValuePass());
        $this->assertEquals($path,  $obj->getValuePath());
        $this->assertEquals($query,  $obj->getValueQuery());
        $this->assertEquals($fragment,  $obj->getValueFragment());
    }



    function dataForTestSetValueFromAPI1ReturnFalse() {
        return array(
            array('',),
        );
    }

    /**
     * @dataProvider dataForTestSetValueFromAPI1ReturnFalse
     */
    function testSetValueFromAPI1ReturnFalse($in) {
        $obj = new FeedbackFieldValueURL();
        $this->assertFalse($obj->setValueFromAPI1($in));
    }

}
