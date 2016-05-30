<?php

namespace FeedbackFieldBundle\Tests\Entity;

use FeedbackFieldBundle\Entity\FeedbackFieldDefinition;
use FeedbackFieldBundle\Entity\FeedbackFieldValueString;
use FeedbackFieldBundle\Entity\FeedbackFieldValueURL;
use FeedbackFieldBundle\Entity\Project;
use FeedbackFieldBundle\Entity\User;
use FeedbackFieldBundle\Tests\BaseTest;
use FeedbackFieldBundle\Tests\BaseTestWithDataBase;

/**
 *  @license 3-clause BSD
 *  @link https://github.com/FeedbackField/FeedbackField-Core
 */
class API1ProjectControllerTest extends BaseTestWithDataBase
{

    function testSaveTextField1() {


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

        $this->em->flush();

        // CALL API TO STORE A FEEDBACK
        $client = static::createClient();
        $crawler = $client->request('GET','/api1/project/test/submit?comment=cats are great');
        $response = $client->getResponse()->getContent();

        // CHECK FEEDBACK
        $feedbackRepo = $this->em->getRepository('FeedbackFieldBundle:Feedback');

        $feedback = $feedbackRepo->findOneByProject($project);

        $this->assertNotNull($feedback);

        $fieldValue = $this->container->get('feedback_field_type_finder')->getFieldTypeById('text')->getFieldValue($feedback, $feedbackFieldDefinition);

        $this->assertNotNull($fieldValue);

        $this->assertEquals('cats are great', $fieldValue->getValueAsString($this->em));


    }

    function testSaveStringField1() {


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

        $this->em->flush();

        // CALL API TO STORE A FEEDBACK
        $client = static::createClient();
        $crawler = $client->request('GET','/api1/project/test/submit?name=fred');
        $response = $client->getResponse()->getContent();

        // CHECK FEEDBACK
        $feedbackRepo = $this->em->getRepository('FeedbackFieldBundle:Feedback');

        $feedback = $feedbackRepo->findOneByProject($project);

        $this->assertNotNull($feedback);

        $fieldValue = $this->container->get('feedback_field_type_finder')->getFieldTypeById('string')->getFieldValue($feedback, $feedbackFieldDefinition);

        $this->assertNotNull($fieldValue);

        $this->assertEquals('fred', $fieldValue->getValueAsString($this->em));


    }

    function testSaveURLField1() {


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
        $feedbackFieldDefinition->setTitle('Page');
        $feedbackFieldDefinition->setPublicId('page');
        $feedbackFieldDefinition->setType('url');
        $feedbackFieldDefinition->setSort(10);
        $feedbackFieldDefinition->setAddedBy($user);
        $this->em->persist($feedbackFieldDefinition);

        $this->em->flush();

        // CALL API TO STORE A FEEDBACK
        $client = static::createClient();
        $crawler = $client->request('GET','/api1/project/test/submit?page=https%3A%2F%2Fgithub.com%2FQuestionKey%2FQuestionKey-Core');
        $response = $client->getResponse()->getContent();

        // CHECK FEEDBACK
        $feedbackRepo = $this->em->getRepository('FeedbackFieldBundle:Feedback');

        $feedback = $feedbackRepo->findOneByProject($project);

        $this->assertNotNull($feedback);

        /** @var FeedbackFieldValueURL $fieldValue */
        $fieldValue = $this->container->get('feedback_field_type_finder')->getFieldTypeById('url')->getFieldValue($feedback, $feedbackFieldDefinition);

        $this->assertNotNull($fieldValue);

        $this->assertEquals('https://github.com/QuestionKey/QuestionKey-Core', $fieldValue->getValueAsString($this->em));
        $this->assertEquals('https', $fieldValue->getValueScheme());
        $this->assertEquals('github.com', $fieldValue->getValueHost());
        $this->assertEquals(443, $fieldValue->getValuePort());
        $this->assertEquals(null, $fieldValue->getValueUser());
        $this->assertEquals(null, $fieldValue->getValuePass());
        $this->assertEquals('/QuestionKey/QuestionKey-Core', $fieldValue->getValuePath());
        $this->assertEquals(null, $fieldValue->getValueQuery());
        $this->assertEquals(null, $fieldValue->getValueFragment());

    }
    
    function testSaveBrowserUserAgentField1() {


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
        $feedbackFieldDefinition->setTitle('User Agent');
        $feedbackFieldDefinition->setPublicId('ua');
        $feedbackFieldDefinition->setType('browseruseragent');
        $feedbackFieldDefinition->setSort(10);
        $feedbackFieldDefinition->setIsAutoFill(true);
        $feedbackFieldDefinition->setAddedBy($user);
        $this->em->persist($feedbackFieldDefinition);

        $this->em->flush();

        // CALL API TO STORE A FEEDBACK
        $client = static::createClient();
        $crawler = $client->request('GET','/api1/project/test/submit?');
        $response = $client->getResponse()->getContent();

        // CHECK FEEDBACK
        $feedbackRepo = $this->em->getRepository('FeedbackFieldBundle:Feedback');

        $feedback = $feedbackRepo->findOneByProject($project);

        $this->assertNotNull($feedback);

        $fieldValue = $this->container->get('feedback_field_type_finder')->getFieldTypeById('browseruseragent')->getFieldValue($feedback, $feedbackFieldDefinition);

        $this->assertNotNull($fieldValue);

        $this->assertEquals('Symfony2 BrowserKit', $fieldValue->getValueAsString($this->em));


    }


}

