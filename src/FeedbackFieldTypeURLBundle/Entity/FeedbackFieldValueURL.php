<?php

namespace FeedbackFieldTypeURLBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FeedbackFieldBundle\Entity\BaseFeedbackFieldValue;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="feedback_field_value_url")
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks
 *
 *  @license 3-clause BSD
 *  @link https://github.com/FeedbackField/FeedbackField-Core
 */
class FeedbackFieldValueURL extends BaseFeedbackFieldValue {

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="text", length=250, nullable=true)
     */
    private $value;


    /**
     * @var string
     *
     * @ORM\Column(name="value_scheme", type="string", length=250, nullable=true)
     */
    private $valueScheme;

    /**
     * @var string
     *
     * @ORM\Column(name="value_host", type="text", nullable=true)
     */
    private $valueHost;

    /**
     * @var integer
     *
     * @ORM\Column(name="value_port", type="integer", nullable=true)
     */
    private $valuePort;

    /**
     * @var string
     *
     * @ORM\Column(name="value_user", type="text", nullable=true)
     */
    private $valueUser;

    /**
     * @var string
     *
     * @ORM\Column(name="value_pass", type="text",  nullable=true)
     */
    private $valuePass;

    /**
     * @var string
     *
     * @ORM\Column(name="value_path", type="text", nullable=true)
     */
    private $valuePath;

    /**
     * @var string
     *
     * @ORM\Column(name="value_query", type="text", nullable=true)
     */
    private $valueQuery;

    /**
     * @var string
     *
     * @ORM\Column(name="value_fragment", type="text", nullable=true)
     */
    private $valueFragment;


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
     * @return string
     */
    public function getValueScheme()
    {
        return $this->valueScheme;
    }

    /**
     * @param string $valueScheme
     */
    public function setValueScheme($valueScheme)
    {
        $this->valueScheme = $valueScheme;
    }

    /**
     * @return string
     */
    public function getValueHost()
    {
        return $this->valueHost;
    }

    /**
     * @param string $valueHost
     */
    public function setValueHost($valueHost)
    {
        $this->valueHost = $valueHost;
    }

    /**
     * @return int
     */
    public function getValuePort()
    {
        return $this->valuePort;
    }

    /**
     * @param int $valuePort
     */
    public function setValuePort($valuePort)
    {
        $this->valuePort = $valuePort;
    }

    /**
     * @return string
     */
    public function getValueUser()
    {
        return $this->valueUser;
    }

    /**
     * @param string $valueUser
     */
    public function setValueUser($valueUser)
    {
        $this->valueUser = $valueUser;
    }

    /**
     * @return string
     */
    public function getValuePass()
    {
        return $this->valuePass;
    }

    /**
     * @param string $valuePass
     */
    public function setValuePass($valuePass)
    {
        $this->valuePass = $valuePass;
    }

    /**
     * @return string
     */
    public function getValuePath()
    {
        return $this->valuePath;
    }

    /**
     * @param string $valuePath
     */
    public function setValuePath($valuePath)
    {
        $this->valuePath = $valuePath;
    }

    /**
     * @return string
     */
    public function getValueQuery()
    {
        return $this->valueQuery;
    }

    /**
     * @param string $valueQuery
     */
    public function setValueQuery($valueQuery)
    {
        $this->valueQuery = $valueQuery;
    }

    /**
     * @return string
     */
    public function getValueFragment()
    {
        return $this->valueFragment;
    }

    /**
     * @param string $valueFragment
     */
    public function setValueFragment($valueFragment)
    {
        $this->valueFragment = $valueFragment;
    }





    /**
     * @param string $value
     * @return boolean
     */
    public function setValueFromAPI1($value)
    {
        if (trim($value)) {
            $this->value = $value;
            $bits = parse_url($value);
            $this->valueScheme = isset($bits['scheme']) ? $bits['scheme'] : null;
            $this->valueHost = isset($bits['host']) ? $bits['host'] : null;
            if (isset($bits['port']) && intval($bits['port'])) {
                $this->valuePort = intval($bits['port']);
            } else if (trim(strtolower($this->valueScheme)) == 'http') {
                $this->valuePort = 80;
            } else if (trim(strtolower($this->valueScheme)) == 'https') {
                $this->valuePort = 443;
            }
            $this->valueUser = isset($bits['user']) ? $bits['user'] : null;
            $this->valuePass = isset($bits['pass']) ? $bits['pass'] : null;
            $this->valuePath = isset($bits['path']) ? $bits['path'] : null;
            $this->valueQuery = isset($bits['query']) ? $bits['query'] : null;
            $this->valueFragment = isset($bits['fragment']) ? $bits['fragment'] : null;
            return true;
        }
        return false;
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
        return array(
            'Scheme'=>$this->valueScheme,
            'Host'=>$this->valueHost,
            'Port'=>$this->valuePort,
            'User'=>$this->valueUser,
            'Pass'=>$this->valuePass,
            'Path'=>$this->valuePath,
            'Query'=>$this->valueQuery,
            'Fragment'=>$this->valueFragment,
        );
    }


}

