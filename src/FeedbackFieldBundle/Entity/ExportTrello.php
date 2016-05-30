<?php

namespace FeedbackFieldBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="export_trello")
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks
 *
 *  @license 3-clause BSD
 *  @link https://github.com/FeedbackField/FeedbackField-Core
 */
class ExportTrello
{


    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="FeedbackFieldBundle\Entity\Export")
     * @ORM\JoinColumn(name="export_id", referencedColumnName="id", nullable=false)
     */
    private $export;

    /**
     * @var string
     *
     * @ORM\Column(name="trello_key", type="string", length=250, nullable=true)
     */
    private $trelloKey;

    /**
     * @var string
     *
     * @ORM\Column(name="trello_token", type="string", length=250, nullable=true)
     */
    private $trelloToken;

    /**
     * @var string
     *
     * @ORM\Column(name="trello_list_id", type="string", length=250, nullable=true)
     */
    private $trelloListId;

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
     * @return string
     */
    public function getTrelloKey()
    {
        return $this->trelloKey;
    }

    /**
     * @param string $trelloKey
     */
    public function setTrelloKey($trelloKey)
    {
        $this->trelloKey = $trelloKey;
    }

    /**
     * @return string
     */
    public function getTrelloToken()
    {
        return $this->trelloToken;
    }

    /**
     * @param string $trelloToken
     */
    public function setTrelloToken($trelloToken)
    {
        $this->trelloToken = $trelloToken;
    }

    /**
     * @return string
     */
    public function getTrelloListId()
    {
        return $this->trelloListId;
    }

    /**
     * @param string $trelloListId
     */
    public function setTrelloListId($trelloListId)
    {
        $this->trelloListId = $trelloListId;
    }



}
