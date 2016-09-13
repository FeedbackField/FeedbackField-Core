<?php

namespace FeedbackFieldBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="feedback_field_definition", uniqueConstraints={@ORM\UniqueConstraint(name="public_id", columns={"project_id", "public_id"})})
 * @ORM\Entity(repositoryClass="FeedbackFieldBundle\Repository\FeedbackFieldDefinitionRepository" )
 * @ORM\HasLifecycleCallbacks
 *
 *  @license 3-clause BSD
 *  @link https://github.com/FeedbackField/FeedbackField-Core
 */
class FeedbackFieldDefinition
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="FeedbackFieldBundle\Entity\Project")
     * @ORM\JoinColumn(name="project_id", referencedColumnName="id", nullable=false)
     */
    private $project;

    /**
     * @ORM\Column(name="public_id", type="string", length=250, unique=false, nullable=false)
     * @Assert\NotBlank()
     */
    private $publicId;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=250, nullable=false)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=250, nullable=false)
     */
    private $title;


    /**
     * @var integer
     *
     * @ORM\Column(name="sort", type="integer", nullable=false)
     */
    private $sort;


    /**
     * @ORM\ManyToOne(targetEntity="FeedbackFieldBundle\Entity\User")
     * @ORM\JoinColumn(name="added_by_id", referencedColumnName="id", nullable=false)
     */
    private $addedBy;

    /**
     * @ORM\Column(name="added_at", type="datetime", nullable=false)
     */
    private $addedAt;

    /**
     * @var integer
     *
     * @ORM\Column(name="anonymise_after_days", type="integer", nullable=false, options={"default" = 0})
     */
    private $anonymiseAfterDays = 0;


    /**
     * @var integer
     *
     * @ORM\Column(name="is_auto_fill", type="boolean", nullable=false)
     */
    private $isAutoFill = false;


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * @param mixed $project
     */
    public function setProject($project)
    {
        $this->project = $project;
    }

    /**
     * @return mixed
     */
    public function getPublicId()
    {
        return $this->publicId;
    }

    /**
     * @param mixed $publicId
     */
    public function setPublicId($publicId)
    {
        $this->publicId = $publicId;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return int
     */
    public function getSort()
    {
        return $this->sort;
    }

    /**
     * @param int $sort
     */
    public function setSort($sort)
    {
        $this->sort = $sort;
    }

    /**
     * @return mixed
     */
    public function getAddedBy()
    {
        return $this->addedBy;
    }

    /**
     * @param mixed $addedBy
     */
    public function setAddedBy($addedBy)
    {
        $this->addedBy = $addedBy;
    }

    /**
     * @return mixed
     */
    public function getAddedAt()
    {
        return $this->addedAt;
    }

    /**
     * @param mixed $addedAt
     */
    public function setAddedAt($addedAt)
    {
        $this->addedAt = $addedAt;
    }

    /**
     * @return int
     */
    public function getAnonymiseAfterDays()
    {
        return $this->anonymiseAfterDays;
    }

    /**
     * @param int $anonymiseAfterDays
     */
    public function setAnonymiseAfterDays($anonymiseAfterDays)
    {
        $this->anonymiseAfterDays = $anonymiseAfterDays;
    }


    /**
     * @return int
     */
    public function getIsAutoFill()
    {
        return $this->isAutoFill;
    }

    /**
     * @param int $isAutoFill
     */
    public function setIsAutoFill($isAutoFill)
    {
        $this->isAutoFill = $isAutoFill;
    }

    /**
     * @ORM\PrePersist()
     */
    public function beforeFirstSave() {
        if (!$this->addedAt) {
            $this->addedAt = new \DateTime("", new \DateTimeZone("UTC"));
        }
    }


}