<?php

namespace FeedbackFieldTypeTextBundle\Tests\Entity;


use FeedbackFieldBundle\Tests\BaseTest;
use FeedbackFieldTypeTextBundle\Entity\FeedbackFieldValueText;


/**
 *  @license 3-clause BSD
 *  @link https://github.com/FeedbackField/FeedbackField-Core
 */
class FeedbackFieldValueTextTest extends BaseTest {



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
        $obj = new FeedbackFieldValueText();
        $this->assertEquals($returned, $obj->setValueFromAPI1($in));
    }

}
