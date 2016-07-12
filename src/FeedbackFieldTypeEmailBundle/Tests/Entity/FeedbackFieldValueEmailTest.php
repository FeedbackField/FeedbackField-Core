<?php

namespace FeedbackFieldTypeEmailBundle\Tests\Entity;

use FeedbackFieldBundle\Tests\BaseTest;
use FeedbackFieldTypeEmailBundle\Entity\FeedbackFieldValueEmail;

/**
 *  @license 3-clause BSD
 *  @link https://github.com/FeedbackField/FeedbackField-Core
 */
class FeedbackFieldValueEmailTest extends BaseTest {



    function dataForTestSetValueFromAPI1() {
        return array(
            array(null,false),
            array('bob@example.com',true),
        );
    }

    /**
     * @dataProvider dataForTestSetValueFromAPI1
     */
    function testSetValueFromAPI1($in, $returned) {
        $obj = new FeedbackFieldValueEmail();
        $this->assertEquals($returned, $obj->setValueFromAPI1($in));
    }

}
