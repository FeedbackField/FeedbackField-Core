<?php

namespace FeedbackFieldTypeStringBundle\Tests\Entity;

use FeedbackFieldBundle\Tests\BaseTest;
use FeedbackFieldTypeStringBundle\Entity\FeedbackFieldValueString;

/**
 *  @license 3-clause BSD
 *  @link https://github.com/FeedbackField/FeedbackField-Core
 */
class FeedbackFieldValueStringTest extends BaseTest {



    function dataForTestSetValueFromAPI1() {
        return array(
            array(null,false),
            array('',false),
            array('    ',false),
            array('   HELLO ',true),
        );
    }

    /**
     * @dataProvider dataForTestSetValueFromAPI1
     */
    function testSetValueFromAPI1($in, $returned) {
        $obj = new FeedbackFieldValueString();
        $this->assertEquals($returned, $obj->setValueFromAPI1($in));
    }

}
