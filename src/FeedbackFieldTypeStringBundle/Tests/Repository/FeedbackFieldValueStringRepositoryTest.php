<?php

namespace FeedbackFieldTypeStringBundle\Tests\Exports;

use FeedbackFieldBundle\DateRange;
use FeedbackFieldBundle\Entity\Export;
use FeedbackFieldBundle\Entity\ExportOnlyIfFeedbackField;
use FeedbackFieldBundle\Entity\Feedback;
use FeedbackFieldBundle\Entity\Project;
use FeedbackFieldBundle\Entity\FeedbackFieldDefinition;
use FeedbackFieldBundle\Entity\User;
use FeedbackFieldBundle\Tests\BaseTest;
use FeedbackFieldBundle\Tests\BaseTestWithDataBase;
use FeedbackFieldTypeStringBundle\Entity\FeedbackFieldValueString;


/**
 *  @license 3-clause BSD
 *  @link https://github.com/FeedbackField/FeedbackField-Core
 */
class FeedbackFieldValueStringRepositoryTest extends BaseTestWithDataBase
{


    function testGetCountWithFieldValue1() {

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
        $feedbackFieldDefinition->setTitle('Name');
        $feedbackFieldDefinition->setPublicId('name');
        $feedbackFieldDefinition->setType('string');
        $feedbackFieldDefinition->setSort(10);
        $feedbackFieldDefinition->setAddedBy($user);
        $this->em->persist($feedbackFieldDefinition);

        $feedback1 = new Feedback();
        $feedback1->setProject($project);
        $feedback1->setCreatedAt(new \DateTime('2016-01-10 10:00:00', new \DateTimeZone('UTC')));
        $this->em->persist($feedback1);

        $feedback1FieldValue = new FeedbackFieldValueString();
        $feedback1FieldValue->setValue('Bob');
        $feedback1FieldValue->setFeedback($feedback1);
        $feedback1FieldValue->setFeedbackFieldDefinition($feedbackFieldDefinition);
        $this->em->persist($feedback1FieldValue);

        $feedback2 = new Feedback();
        $feedback2->setProject($project);
        $feedback2->setCreatedAt(new \DateTime('2016-02-10 10:00:00', new \DateTimeZone('UTC')));
        $this->em->persist($feedback2);

        $feedback2FieldValue = new FeedbackFieldValueString();
        $feedback2FieldValue->setValue('Bob');
        $feedback2FieldValue->setFeedback($feedback2);
        $feedback2FieldValue->setFeedbackFieldDefinition($feedbackFieldDefinition);
        $this->em->persist($feedback2FieldValue);

        $feedback3 = new Feedback();
        $feedback3->setProject($project);
        $feedback3->setCreatedAt(new \DateTime('2016-03-10 10:00:00', new \DateTimeZone('UTC')));
        $this->em->persist($feedback3);

        $this->em->flush();

        $feedbackRepo = $this->em->getRepository('FeedbackFieldTypeStringBundle:FeedbackFieldValueString');

        $this->assertEquals(2, $feedbackRepo->getCountWithFieldValue(
            $project,
            new DateRange(
                new \DateTime('2010-01-01 10:00:00', new \DateTimeZone('UTC')),
                new \DateTime('2020-01-01 10:00:00', new \DateTimeZone('UTC'))
            ),
            $feedbackFieldDefinition
        ));

        $this->assertEquals(1, $feedbackRepo->getCountWithFieldValue(
            $project,
            new DateRange(
                new \DateTime('2016-02-01 10:00:00', new \DateTimeZone('UTC')),
                new \DateTime('2016-04-01 10:00:00', new \DateTimeZone('UTC'))
            ),
            $feedbackFieldDefinition
        ));

    }




}
