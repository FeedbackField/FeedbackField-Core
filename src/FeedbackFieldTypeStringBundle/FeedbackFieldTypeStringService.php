<?php

namespace FeedbackFieldTypeStringBundle;

use FeedbackFieldBundle\DateRange;
use FeedbackFieldBundle\Entity\BaseFeedbackFieldValue;
use FeedbackFieldBundle\Entity\Feedback;
use FeedbackFieldBundle\Entity\FeedbackFieldDefinition;
use FeedbackFieldBundle\Entity\Project;
use FeedbackFieldBundle\FeedbackFieldTypeInterface;
use FeedbackFieldBundle\FeedbackFieldTypeServiceInterface;
use FeedbackFieldTypeStringBundle\Entity\FeedbackFieldValueString;

class FeedbackFieldTypeStringService implements FeedbackFieldTypeServiceInterface
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
        return "string";
    }

    public function getTitle()
    {
        return "String";
    }

    public function isAutoFillPossible()
    {
        return false;
    }

    public function getNewValueEntity()
    {
        return new FeedbackFieldValueString();
    }

    public function getFieldValue(Feedback $feedback, FeedbackFieldDefinition $FeedbackFieldDefinition)
    {
        return $this->container->get('doctrine')->getEntityManager()->
            getRepository('FeedbackFieldTypeStringBundle:FeedbackFieldValueString')->
            findOneBy(array('feedback'=>$feedback, 'feedbackFieldDefinition'=>$FeedbackFieldDefinition));
    }

    public function getCountWithFieldValue(Project $project, DateRange $dateRange, FeedbackFieldDefinition $feedbackFieldDefinition)
    {
        return $this->container->get('doctrine')->getEntityManager()->
            getRepository('FeedbackFieldTypeStringBundle:FeedbackFieldValueString')->
            getCountWithFieldValue($project, $dateRange, $feedbackFieldDefinition);
    }


    public function getFieldStatsLinks(Project $project, FeedbackFieldDefinition $feedbackFieldDefinition)
    {
        return array(
            array(
                'label' => 'ENUM Data',
                'url' => $this->container->get('router')->generate('feedbackfield_admin_project_feedback_field_string_enum',
                    array('projectId'=>$project->getPublicId(),'fieldDefinitionId'=>$feedbackFieldDefinition->getPublicId())),
            ),
        );
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
