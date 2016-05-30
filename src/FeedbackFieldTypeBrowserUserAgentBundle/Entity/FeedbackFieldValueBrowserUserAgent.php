<?php

namespace FeedbackFieldTypeBrowserUserAgentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FeedbackFieldBundle\Entity\BaseFeedbackFieldValue;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="feedback_field_value_browser_user_agent")
 * @ORM\Entity(repositoryClass="FeedbackFieldTypeBrowserUserAgentBundle\Repository\FeedbackFieldValueBrowserUserAgentRepository")
 * @ORM\HasLifecycleCallbacks
 *
 *  @license 3-clause BSD
 *  @link https://github.com/FeedbackField/FeedbackField-Core
 */
class FeedbackFieldValueBrowserUserAgent extends BaseFeedbackFieldValue {

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


    public function getValueAsString($doctrine)
    {
        return $this->value;
    }


    public function setAutoFilledValueFromAPI1(Request $request)
    {
        $this->value = $request->headers->get('User-Agent');
        return (boolean)$this->value;
    }

}

