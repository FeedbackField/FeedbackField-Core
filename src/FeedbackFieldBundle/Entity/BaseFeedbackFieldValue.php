<?php

namespace FeedbackFieldBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

/**
 *  @license 3-clause BSD
 *  @link https://github.com/FeedbackField/FeedbackField-Core
 */
abstract class BaseFeedbackFieldValue {



    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="FeedbackFieldBundle\Entity\Feedback")
     * @ORM\JoinColumn(name="feedback_id", referencedColumnName="id", nullable=false)
     */
    protected $feedback;


    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="FeedbackFieldBundle\Entity\FeedbackFieldDefinition")
     * @ORM\JoinColumn(name="feedback_field_definition_id", referencedColumnName="id", nullable=false)
     */
    protected $feedbackFieldDefinition;


    public  abstract function getValueAsString($doctrine);

    public abstract function setValueFromAPI1($value);

    public abstract function setAutoFilledValueFromAPI1(Request $request);


    /**
     * @return mixed
     */
    public function getFeedback()
    {
        return $this->feedback;
    }

    /**
     * @param mixed $feedback
     */
    public function setFeedback($feedback)
    {
        $this->feedback = $feedback;
    }

    /**
     * @return mixed
     */
    public function getFeedbackFieldDefinition()
    {
        return $this->feedbackFieldDefinition;
    }

    /**
     * @param mixed $feedbackFieldDefinition
     */
    public function setFeedbackFieldDefinition($feedbackFieldDefinition)
    {
        $this->feedbackFieldDefinition = $feedbackFieldDefinition;
    }

}

