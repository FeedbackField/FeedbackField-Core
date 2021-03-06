<?php

namespace FeedbackFieldTypeEmailBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FeedbackFieldBundle\Entity\BaseFeedbackFieldValue;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="feedback_field_value_email")
 * @ORM\Entity(repositoryClass="FeedbackFieldTypeEmailBundle\Repository\FeedbackFieldValueEmailRepository")
 * @ORM\HasLifecycleCallbacks
 *
 *  @license 3-clause BSD
 *  @link https://github.com/FeedbackField/FeedbackField-Core
 */
class FeedbackFieldValueEmail extends BaseFeedbackFieldValue {

    /**
     * @var String
     *
     * @ORM\Column(name="value", type="text", nullable=true)
     */
    private $value;


    /**
     * @return String
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param String $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }


    /**
     * @param String $value
     * @return boolean
     */
    public function setValueFromAPI1($value)
    {
        $this->value = $value;
        return (boolean)trim($value);
    }

    public function setAutoFilledValueFromAPI1(Request $request)
    {
        // N/A for this type
        return false;
    }


    public function getValueAsString($doctrine)
    {
        return $this->value;
    }


    public function getSubValuesAsString($doctrine)
    {
        return array();
    }

}

