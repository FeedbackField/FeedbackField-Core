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
     * @var string
     *
     * @ORM\Column(name="value_device_type", type="string", length=250, nullable=true)
     */
    private $valueDeviceType;

    /**
     * @var string
     *
     * @ORM\Column(name="value_device_pointing_method", type="string", length=250, nullable=true)
     */
    private $valueDevicePointingMethod;

    /**
     * @var string
     *
     * @ORM\Column(name="value_comment", type="string", length=250, nullable=true)
     */
    private $valueComment;

    /**
     * @var string
     *
     * @ORM\Column(name="value_parent", type="string", length=250, nullable=true)
     */
    private $valueParent;

    /**
     * @var string
     *
     * @ORM\Column(name="value_browser", type="string", length=250, nullable=true)
     */
    private $valueBrowser;

    /**
     * @var string
     *
     * @ORM\Column(name="value_browser_maker", type="string", length=250, nullable=true)
     */
    private $valueBrowserMaker;

    /**
     * @var string
     *
     * @ORM\Column(name="value_platform", type="string", length=250, nullable=true)
     */
    private $valuePlatform;


    /**
     * @var string
     *
     * @ORM\Column(name="value_version", type="string", length=250, nullable=true)
     */
    private $valueVersion;

    /**
     * @var string
     *
     * @ORM\Column(name="value_version_major", type="string", length=250, nullable=true)
     */
    private $valueVersionMajor;


    /**
     * @var string
     *
     * @ORM\Column(name="value_version_minor", type="string", length=250, nullable=true)
     */
    private $valueVersionMinor;


    /**
     * @var string
     *
     * @ORM\Column(name="value_is_mobile", type="boolean", nullable=true)
     */
    private $valueIsMobile;

    /**
     * @var string
     *
     * @ORM\Column(name="value_is_tablet", type="boolean", nullable=true)
     */
    private $valueIsTablet;

    /**
     * @var string
     *
     * @ORM\Column(name="value_is_crawler", type="boolean", nullable=true)
     */
    private $valueIsCrawler;

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
    public function getValueDeviceType()
    {
        return $this->valueDeviceType;
    }

    /**
     * @param string $valueDeviceType
     */
    public function setValueDeviceType($valueDeviceType)
    {
        $this->valueDeviceType = $valueDeviceType;
    }

    /**
     * @return string
     */
    public function getValueDevicePointingMethod()
    {
        return $this->valueDevicePointingMethod;
    }

    /**
     * @param string $valueDevicePointingMethod
     */
    public function setValueDevicePointingMethod($valueDevicePointingMethod)
    {
        $this->valueDevicePointingMethod = $valueDevicePointingMethod;
    }

    /**
     * @return string
     */
    public function getValueComment()
    {
        return $this->valueComment;
    }

    /**
     * @param string $valueComment
     */
    public function setValueComment($valueComment)
    {
        $this->valueComment = $valueComment;
    }

    /**
     * @return string
     */
    public function getValueParent()
    {
        return $this->valueParent;
    }

    /**
     * @param string $valueParent
     */
    public function setValueParent($valueParent)
    {
        $this->valueParent = $valueParent;
    }

    /**
     * @return string
     */
    public function getValueBrowser()
    {
        return $this->valueBrowser;
    }

    /**
     * @param string $valueBrowser
     */
    public function setValueBrowser($valueBrowser)
    {
        $this->valueBrowser = $valueBrowser;
    }

    /**
     * @return string
     */
    public function getValueBrowserMaker()
    {
        return $this->valueBrowserMaker;
    }

    /**
     * @param string $valueBrowserMaker
     */
    public function setValueBrowserMaker($valueBrowserMaker)
    {
        $this->valueBrowserMaker = $valueBrowserMaker;
    }

    /**
     * @return string
     */
    public function getValuePlatform()
    {
        return $this->valuePlatform;
    }

    /**
     * @param string $valuePlatform
     */
    public function setValuePlatform($valuePlatform)
    {
        $this->valuePlatform = $valuePlatform;
    }

    /**
     * @return string
     */
    public function getValueVersion()
    {
        return $this->valueVersion;
    }

    /**
     * @param string $valueVersion
     */
    public function setValueVersion($valueVersion)
    {
        $this->valueVersion = $valueVersion;
    }

    /**
     * @return string
     */
    public function getValueVersionMajor()
    {
        return $this->valueVersionMajor;
    }

    /**
     * @param string $valueVersionMajor
     */
    public function setValueVersionMajor($valueVersionMajor)
    {
        $this->valueVersionMajor = $valueVersionMajor;
    }

    /**
     * @return string
     */
    public function getValueVersionMinor()
    {
        return $this->valueVersionMinor;
    }

    /**
     * @param string $valueVersionMinor
     */
    public function setValueVersionMinor($valueVersionMinor)
    {
        $this->valueVersionMinor = $valueVersionMinor;
    }

    /**
     * @return string
     */
    public function getValueIsMobile()
    {
        return $this->valueIsMobile;
    }

    /**
     * @param string $valueIsMobile
     */
    public function setValueIsMobile($valueIsMobile)
    {
        $this->valueIsMobile = $valueIsMobile;
    }

    /**
     * @return string
     */
    public function getValueIsTablet()
    {
        return $this->valueIsTablet;
    }

    /**
     * @param string $valueIsTablet
     */
    public function setValueIsTablet($valueIsTablet)
    {
        $this->valueIsTablet = $valueIsTablet;
    }

    /**
     * @return string
     */
    public function getValueIsCrawler()
    {
        return $this->valueIsCrawler;
    }

    /**
     * @param string $valueIsCrawler
     */
    public function setValueIsCrawler($valueIsCrawler)
    {
        $this->valueIsCrawler = $valueIsCrawler;
    }

    public function hasValue() {
        return (boolean)$this->value;
    }

    public function hasAnySubValues() {
        // This doesn't check everything, but it checks enought.
        return (boolean)$this->valueBrowser || (boolean)$this->valueBrowserMaker || (boolean)$this->valueComment || (boolean)$this->valueDevicePointingMethod || (boolean)$this->valueParent
            || (boolean)$this->valuePlatform;
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

    public function getSubValuesAsString($doctrine)
    {
        return array(
            'BrowserMaker'=>$this->valueBrowserMaker,
            'Browser'=>$this->valueBrowser,
            'Version'=>$this->valueVersion,
            'VersionMajor'=>$this->valueVersionMajor,
            'VersionMinor'=>$this->valueVersionMinor,
            'Platform'=>$this->valuePlatform,
            'IsMobile'=>$this->valueIsMobile ? 'yes' : 'no',
            'IsTablet'=>$this->valueIsTablet ? 'yes' : 'no',
            'IsCrawler'=>$this->valueIsCrawler ? 'yes' : 'no',
            'DeviceType'=>$this->valueDeviceType,
            'DevicePointingMethod'=>$this->valueDevicePointingMethod,
            'Comment'=>$this->valueComment,
            'Parent'=>$this->valueParent,
        );
    }
}

