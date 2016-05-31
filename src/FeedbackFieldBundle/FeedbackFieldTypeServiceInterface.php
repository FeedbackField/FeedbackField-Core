<?php

namespace FeedbackFieldBundle;
use FeedbackFieldBundle\Entity\BaseFeedbackFieldValue;
use FeedbackFieldBundle\Entity\Feedback;
use FeedbackFieldBundle\Entity\FeedbackFieldDefinition;
use FeedbackFieldBundle\Entity\Project;

/**
 *  @license 3-clause BSD
 *  @link https://github.com/FeedbackField/FeedbackField-Core
 */


interface FeedbackFieldTypeServiceInterface {


    public function getId();

    public function getTitle();

    public function isAutoFillPossible();

    public function getNewValueEntity();

    public function getFieldValue(Feedback $feedback, FeedbackFieldDefinition $FeedbackFieldDefinition);

    public function getCountWithFieldValue(Project $project, DateRange $dateRange, FeedbackFieldDefinition $feedbackFieldDefinition);

    public function getFieldStatsLinks(Project $project, FeedbackFieldDefinition $feedbackFieldDefinition);

    public function callPostPersistForField(Project $project, FeedbackFieldDefinition $feedbackFieldDefinition, BaseFeedbackFieldValue $feedbackFieldValue);

}