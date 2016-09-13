<?php

namespace FeedbackFieldTypeBrowserUserAgentBundle;


use FeedbackFieldBundle\DateRange;
use FeedbackFieldBundle\Entity\BaseFeedbackFieldValue;
use FeedbackFieldBundle\Entity\Feedback;
use FeedbackFieldBundle\Entity\FeedbackFieldDefinition;
use FeedbackFieldBundle\Entity\Project;
use FeedbackFieldBundle\FeedbackFieldTypeInterface;
use FeedbackFieldBundle\FeedbackFieldTypeServiceInterface;
use FeedbackFieldTypeBrowserUserAgentBundle\Entity\FeedbackFieldValueBrowserUserAgent;

class FeedbackFieldTypeBrowserUserAgentService implements FeedbackFieldTypeServiceInterface
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
        return "browseruseragent";
    }

    public function getTitle()
    {
        return "Browser User Agent";
    }

    public function isAutoFillPossible()
    {
        return true;
    }

    public function getNewValueEntity()
    {
        return new FeedbackFieldValueBrowserUserAgent();
    }


    public function getFieldValue(Feedback $feedback, FeedbackFieldDefinition $FeedbackFieldDefinition)
    {
        return $this->container->get('doctrine')->getEntityManager()->
        getRepository('FeedbackFieldTypeBrowserUserAgentBundle:FeedbackFieldValueBrowserUserAgent')->
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
        if ($feedbackFieldValue->hasValue() && !$feedbackFieldValue->hasAnySubValues()) {
            $data = $this->container->get('browscap')->getBrowsCap()->getBrowser($feedbackFieldValue->getValue());
            $feedbackFieldValue->setValueDeviceType($data->Device_Type);
            $feedbackFieldValue->setValueDevicePointingMethod($data->Device_Pointing_Method);
            $feedbackFieldValue->setValueComment($data->Comment);
            $feedbackFieldValue->setValueParent($data->Parent);
            $feedbackFieldValue->setValueBrowser($data->Browser);
            $feedbackFieldValue->setValueBrowserMaker($data->Browser_Maker);
            $feedbackFieldValue->setValuePlatform($data->Platform);
            $feedbackFieldValue->setValueVersion($data->Version);
            $feedbackFieldValue->setValueVersionMajor($data->MajorVer);
            $feedbackFieldValue->setValueVersionMinor($data->MinorVer);
            $feedbackFieldValue->setValueIsMobile($data->isMobileDevice);
            $feedbackFieldValue->setValueIsTablet($data->isTablet);
            $feedbackFieldValue->setValueIsCrawler($data->Crawler);
            return true;
        }
        return false;
    }

    public function anonymiseFieldContents(Project $project, FeedbackFieldDefinition $feedbackFieldDefinition)
    {
        // TODO: Implement anonymiseFieldContents() method.
    }
}
