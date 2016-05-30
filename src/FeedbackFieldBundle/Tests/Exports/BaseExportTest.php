<?php

namespace FeedbackFieldBundle\Tests\Exports;

use FeedbackFieldBundle\Entity\Export;
use FeedbackFieldBundle\Entity\ExportOnlyIfFeedbackField;
use FeedbackFieldBundle\Entity\Feedback;
use FeedbackFieldBundle\Entity\Project;
use FeedbackFieldBundle\Entity\FeedbackFieldDefinition;
use FeedbackFieldBundle\Entity\User;
use FeedbackFieldBundle\Tests\BaseTest;
use FeedbackFieldBundle\Tests\BaseTestWithDataBase;
use FeedbackFieldTypeTextBundle\Entity\FeedbackFieldValueText;


/**
 *  @license 3-clause BSD
 *  @link https://github.com/FeedbackField/FeedbackField-Core
 */
class BaseExportTest extends BaseTestWithDataBase {

    /** Text Field Has Value */
    function testGetTextOfAllContentForTextField1() {


        $user = new User();
        $user->setUsername('test');
        $user->setEmail('test@example.org');
        $user->setPassword('oeuoeu');
        $this->em->persist($user);

        $project = new Project();
        $project->setTitle('TEST');
        $project->setPublicId('test');
        $project->setActive(true);
        $project->setOwner($user);
        $this->em->persist($project);

        $FeedbackFieldDefinition = new FeedbackFieldDefinition();
        $FeedbackFieldDefinition->setProject($project);
        $FeedbackFieldDefinition->setTitle('Comment');
        $FeedbackFieldDefinition->setPublicId('comment');
        $FeedbackFieldDefinition->setType('text');
        $FeedbackFieldDefinition->setSort(10);
        $FeedbackFieldDefinition->setAddedBy($user);
        $this->em->persist($FeedbackFieldDefinition);

        $feedback = new Feedback();
        $feedback->setProject($project);
        $feedback->setPublicId('test');
        $this->em->persist($feedback);

        $feedbackFieldValueText = new FeedbackFieldValueText();
        $feedbackFieldValueText->setFeedback($feedback);
        $feedbackFieldValueText->setFeedbackFieldDefinition($FeedbackFieldDefinition);
        $feedbackFieldValueText->setValue("Cat\nDog\nLizard");
        $this->em->persist($feedbackFieldValueText);

        $export = new Export();
        $export->setPublicId('export1');
        $export->setProject($project);
        $export->setType('Trello');

        $this->em->flush();

        $extendBaseExport = new ExtendBaseExport($export, $this->container);

        $this->assertEquals(
            trim(file_get_contents(__DIR__. DIRECTORY_SEPARATOR. 'data'.DIRECTORY_SEPARATOR.'BaseExportTest_testGetTextOfAllContentForTextField1.txt')),
            trim($extendBaseExport->extendGetTextOfAllContent($feedback))
        );


    }

    /** Text Field Has No Value */
    function testGetTextOfAllContentForTextField2() {


        $user = new User();
        $user->setUsername('test');
        $user->setEmail('test@example.org');
        $user->setPassword('oeuoeu');
        $this->em->persist($user);

        $project = new Project();
        $project->setTitle('TEST');
        $project->setPublicId('test');
        $project->setActive(true);
        $project->setOwner($user);
        $this->em->persist($project);

        $FeedbackFieldDefinition = new FeedbackFieldDefinition();
        $FeedbackFieldDefinition->setProject($project);
        $FeedbackFieldDefinition->setTitle('Comment');
        $FeedbackFieldDefinition->setPublicId('comment');
        $FeedbackFieldDefinition->setType('text');
        $FeedbackFieldDefinition->setSort(10);
        $FeedbackFieldDefinition->setAddedBy($user);
        $this->em->persist($FeedbackFieldDefinition);

        $feedback = new Feedback();
        $feedback->setProject($project);
        $feedback->setPublicId('test');
        $this->em->persist($feedback);

        // NO FIELD VALUE!

        $export = new Export();
        $export->setPublicId('export1');
        $export->setProject($project);
        $export->setType('Trello');

        $this->em->flush();

        $extendBaseExport = new ExtendBaseExport($export, $this->container);

        $this->assertEquals(
            trim(file_get_contents(__DIR__. DIRECTORY_SEPARATOR. 'data'.DIRECTORY_SEPARATOR.'BaseExportTest_testGetTextOfAllContentForTextField2.txt')),
            trim($extendBaseExport->extendGetTextOfAllContent($feedback))
        );


    }

    /** Should export when no ExportOnlyIfFeedbackField set */
    function testShouldExportThisFeedbackNoFieldSet() {

        $user = new User();
        $user->setUsername('test');
        $user->setEmail('test@example.org');
        $user->setPassword('oeuoeu');
        $this->em->persist($user);

        $project = new Project();
        $project->setTitle('TEST');
        $project->setPublicId('test');
        $project->setActive(true);
        $project->setOwner($user);
        $this->em->persist($project);

        $FeedbackFieldDefinition = new FeedbackFieldDefinition();
        $FeedbackFieldDefinition->setProject($project);
        $FeedbackFieldDefinition->setTitle('Comment');
        $FeedbackFieldDefinition->setPublicId('comment');
        $FeedbackFieldDefinition->setType('text');
        $FeedbackFieldDefinition->setSort(10);
        $FeedbackFieldDefinition->setAddedBy($user);
        $this->em->persist($FeedbackFieldDefinition);

        $feedback = new Feedback();
        $feedback->setProject($project);
        $feedback->setPublicId('test');
        $this->em->persist($feedback);

        // NO FIELD VALUE!

        $export = new Export();
        $export->setPublicId('export1');
        $export->setProject($project);
        $export->setType('Trello');

        $this->em->flush();

        $extendBaseExport = new ExtendBaseExport($export, $this->container);

        $this->assertTrue($extendBaseExport->extendShouldExportThisFeedback($feedback));

    }

    /** Should not export when a ExportOnlyIfFeedbackField is set and feedback has no such value */
    function testShouldExportThisFeedbackFieldSetNoValue() {

        $user = new User();
        $user->setUsername('test');
        $user->setEmail('test@example.org');
        $user->setPassword('oeuoeu');
        $this->em->persist($user);

        $project = new Project();
        $project->setTitle('TEST');
        $project->setPublicId('test');
        $project->setActive(true);
        $project->setOwner($user);
        $this->em->persist($project);

        $feedbackFieldDefinition = new FeedbackFieldDefinition();
        $feedbackFieldDefinition->setProject($project);
        $feedbackFieldDefinition->setTitle('Comment');
        $feedbackFieldDefinition->setPublicId('comment');
        $feedbackFieldDefinition->setType('text');
        $feedbackFieldDefinition->setSort(10);
        $feedbackFieldDefinition->setAddedBy($user);
        $this->em->persist($feedbackFieldDefinition);

        $feedback = new Feedback();
        $feedback->setProject($project);
        $feedback->setPublicId('test');
        $this->em->persist($feedback);

        // NO FIELD VALUE!

        $export = new Export();
        $export->setPublicId('export1');
        $export->setProject($project);
        $export->setType('Trello');
        $this->em->persist($export);

        $exportOnlyIfFeedbackField = new ExportOnlyIfFeedbackField();
        $exportOnlyIfFeedbackField->setExport($export);
        $exportOnlyIfFeedbackField->setFeedbackFieldDefinition($feedbackFieldDefinition);
        $this->em->persist($exportOnlyIfFeedbackField);

        $this->em->flush();

        $extendBaseExport = new ExtendBaseExport($export, $this->container);

        $this->assertFalse($extendBaseExport->extendShouldExportThisFeedback($feedback));

    }

    /** Should export when a ExportOnlyIfFeedbackField is set and feedback has a value! */
    function testShouldExportThisFeedbackFieldSetAValue() {

        $user = new User();
        $user->setUsername('test');
        $user->setEmail('test@example.org');
        $user->setPassword('oeuoeu');
        $this->em->persist($user);

        $project = new Project();
        $project->setTitle('TEST');
        $project->setPublicId('test');
        $project->setActive(true);
        $project->setOwner($user);
        $this->em->persist($project);

        $FeedbackFieldDefinition = new FeedbackFieldDefinition();
        $FeedbackFieldDefinition->setProject($project);
        $FeedbackFieldDefinition->setTitle('Comment');
        $FeedbackFieldDefinition->setPublicId('comment');
        $FeedbackFieldDefinition->setType('text');
        $FeedbackFieldDefinition->setSort(10);
        $FeedbackFieldDefinition->setAddedBy($user);
        $this->em->persist($FeedbackFieldDefinition);

        $feedback = new Feedback();
        $feedback->setProject($project);
        $feedback->setPublicId('test');
        $this->em->persist($feedback);

        $feedbackFieldValueText = new FeedbackFieldValueText();
        $feedbackFieldValueText->setFeedback($feedback);
        $feedbackFieldValueText->setFeedbackFieldDefinition($FeedbackFieldDefinition);
        $feedbackFieldValueText->setValue("Cat\nDog\nLizard");
        $this->em->persist($feedbackFieldValueText);

        $export = new Export();
        $export->setPublicId('export1');
        $export->setProject($project);
        $export->setType('Trello');
        $this->em->persist($export);

        $exportOnlyIfFeedbackField = new ExportOnlyIfFeedbackField();
        $exportOnlyIfFeedbackField->setExport($export);
        $exportOnlyIfFeedbackField->setFeedbackFieldDefinition($FeedbackFieldDefinition);
        $this->em->persist($exportOnlyIfFeedbackField);

        $this->em->flush();

        $extendBaseExport = new ExtendBaseExport($export, $this->container);

        $this->assertTrue($extendBaseExport->extendShouldExportThisFeedback($feedback));

    }


}
