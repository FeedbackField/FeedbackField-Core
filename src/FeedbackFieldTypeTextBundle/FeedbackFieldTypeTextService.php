<?php

namespace FeedbackFieldTypeTextBundle;

use FeedbackFieldBundle\DateRange;
use FeedbackFieldBundle\Entity\Feedback;
use FeedbackFieldBundle\Entity\FeedbackFieldDefinition;
use FeedbackFieldBundle\Entity\Project;
use FeedbackFieldBundle\FeedbackFieldTypeInterface;
use FeedbackFieldBundle\FeedbackFieldTypeServiceInterface;
use FeedbackFieldTypeTextBundle\Entity\FeedbackFieldValueText;

class FeedbackFieldTypeTextService implements FeedbackFieldTypeServiceInterface
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
        return "text";
    }

    public function getTitle()
    {
        return "Text";
    }

    public function isAutoFillPossible()
    {
        return false;
    }

    public function getNewValueEntity()
    {
        return new FeedbackFieldValueText();
    }


    public function getFieldValue(Feedback $feedback, FeedbackFieldDefinition $FeedbackFieldDefinition)
    {
        return $this->container->get('doctrine')->getEntityManager()->
        getRepository('FeedbackFieldTypeTextBundle:FeedbackFieldValueText')->
        findOneBy(array('feedback'=>$feedback, 'feedbackFieldDefinition'=>$FeedbackFieldDefinition));
    }

    public function getCountWithFieldValue(Project $project, DateRange $dateRange, FeedbackFieldDefinition $feedbackFieldDefinition)
    {
        return $this->container->get('doctrine')->getEntityManager()->
            getRepository('FeedbackFieldTypeTextBundle:FeedbackFieldValueText')->
            getCountWithFieldValue($project, $dateRange, $feedbackFieldDefinition);
    }


    public function getFieldStatsLinks(Project $project, FeedbackFieldDefinition $feedbackFieldDefinition)
    {
        return array();
    }

}
