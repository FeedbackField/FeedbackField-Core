<?php

namespace FeedbackFieldBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="export_only_if_feedback_field")
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks
 *
 *  @license 3-clause BSD
 *  @link https://github.com/FeedbackField/FeedbackField-Core
 */
class ExportOnlyIfFeedbackField
{
    /**
     * @ORM\ID
     * @ORM\ManyToOne(targetEntity="FeedbackFieldBundle\Entity\Export")
     * @ORM\JoinColumn(name="export_id", referencedColumnName="id", nullable=false)
     */
    private $export;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="FeedbackFieldBundle\Entity\FeedbackFieldDefinition")
     * @ORM\JoinColumn(name="feedback_field_definition_id", referencedColumnName="id", nullable=false)
     */
    protected $feedbackFieldDefinition;

    /**
     * @var \DateTime $createdAt
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;


    /**
     * @return mixed
     */
    public function getExport()
    {
        return $this->export;
    }

    /**
     * @param mixed $export
     */
    public function setExport($export)
    {
        $this->export = $export;
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


    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }


    /**
     * @ORM\PrePersist()
     */
    public function beforeFirstSave() {
        if (!$this->createdAt) {
            $this->createdAt = new \DateTime("", new \DateTimeZone("UTC"));
        }
    }


}
