<?php

namespace FeedbackFieldTypeTextBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FeedbackFieldBundle\Entity\BaseFeedbackFieldValue;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="feedback_field_value_text")
 * @ORM\Entity(repositoryClass="FeedbackFieldTypeTextBundle\Repository\FeedbackFieldValueTextRepository")
 * @ORM\HasLifecycleCallbacks
 *
 *  @license 3-clause BSD
 *  @link https://github.com/FeedbackField/FeedbackField-Core
 */
class FeedbackFieldValueText extends BaseFeedbackFieldValue {

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="text", nullable=true)
     */
    private $value;


    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }


    /**
     * @param string $value
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

}

