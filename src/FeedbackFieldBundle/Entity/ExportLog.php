<?php

namespace FeedbackFieldBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="export_log")
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks
 *
 *  @license 3-clause BSD
 *  @link https://github.com/FeedbackField/FeedbackField-Core
 */
class ExportLog
{
    /**
     * @ORM\ID
     * @ORM\ManyToOne(targetEntity="FeedbackFieldBundle\Entity\Export")
     * @ORM\JoinColumn(name="export_id", referencedColumnName="id", nullable=false)
     */
    private $export;

    /**
     * @ORM\ID
     * @ORM\ManyToOne(targetEntity="FeedbackFieldBundle\Entity\Feedback")
     * @ORM\JoinColumn(name="feedback_id", referencedColumnName="id", nullable=false)
     */
    private $feedback;

    /**
     * @var \DateTime $createdAt
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @var \DateTime $createdAt
     *
     * @ORM\Column(name="done_at", type="datetime", nullable=true)
     */
    private $doneAt;


    /**
     * @var \DateTime $createdAt
     *
     * @ORM\Column(name="rejected_at", type="datetime", nullable=true)
     */
    private $rejectedAt;

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
     * @return \DateTime
     */
    public function getDoneAt()
    {
        return $this->doneAt;
    }

    /**
     * @param \DateTime $doneAt
     */
    public function setDoneAt($doneAt)
    {
        $this->doneAt = $doneAt;
    }

    /**
     * @return \DateTime
     */
    public function getRejectedAt()
    {
        return $this->rejectedAt;
    }

    /**
     * @param \DateTime $rejectedAt
     */
    public function setRejectedAt($rejectedAt)
    {
        $this->rejectedAt = $rejectedAt;
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
