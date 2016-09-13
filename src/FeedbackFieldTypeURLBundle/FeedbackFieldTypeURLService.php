<?php

namespace FeedbackFieldTypeURLBundle;

use FeedbackFieldBundle\DateRange;
use FeedbackFieldBundle\Entity\BaseFeedbackFieldValue;
use FeedbackFieldBundle\Entity\Feedback;
use FeedbackFieldBundle\Entity\FeedbackFieldDefinition;
use FeedbackFieldBundle\Entity\Project;
use FeedbackFieldBundle\FeedbackFieldExtensionBundlesInterface;
use FeedbackFieldBundle\FeedbackFieldTypeInterface;
use FeedbackFieldBundle\FeedbackFieldTypeServiceInterface;
use FeedbackFieldTypeURLBundle\Entity\FeedbackFieldValueURL;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class FeedbackFieldTypeURLService implements FeedbackFieldTypeServiceInterface
{

    protected $container;

    /**
     * FeedbackFieldTypeURL constructor.
     * @param $container
     */
    public function __construct($container)
    {
        $this->container = $container;
    }


    public function getId()
    {
        return "url";
    }

    public function getTitle()
    {
        return "URL";
    }

    public function isAutoFillPossible()
    {
        return false;
    }

    public function getNewValueEntity()
    {
        return new FeedbackFieldValueURL();
    }

    public function getFieldValue(Feedback $feedback, FeedbackFieldDefinition $FeedbackFieldDefinition)
    {
        return $this->container->get('doctrine')->getEntityManager()->
        getRepository('FeedbackFieldTypeURLBundle:FeedbackFieldValueURL')->
        findOneBy(array('feedback'=>$feedback, 'feedbackFieldDefinition'=>$FeedbackFieldDefinition));
    }

    public function getCountWithFieldValue(Project $project, DateRange $dateRange, FeedbackFieldDefinition $feedbackFieldDefinition)
    {
        return null;
    }

    public function getFieldStatsLinks(Project $project, FeedbackFieldDefinition $feedbackFieldDefinition)
    {
        return array();
    }

    public function callPostPersistForField(Project $project, FeedbackFieldDefinition $feedbackFieldDefinition, BaseFeedbackFieldValue $feedbackFieldValue)
    {
        return false;
    }

    public function anonymiseFieldContents(Project $project, FeedbackFieldDefinition $feedbackFieldDefinition)
    {
        // TODO: Implement anonymiseFieldContents() method.
    }
}
