<?php

namespace FeedbackFieldBundle\Exports;

use FeedbackFieldBundle\Entity\Export;
use FeedbackFieldBundle\Entity\ExportLog;
use FeedbackFieldBundle\Entity\ExportTrello;
use FeedbackFieldBundle\Entity\ExportTrelloGotFeedback;
use FeedbackFieldBundle\Entity\Feedback;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

/**
 *  @license 3-clause BSD
 *  @link https://github.com/FeedbackField/FeedbackField-Core
 */
class ExportFeedbackToTrello extends BaseExport
{


    /** @var  ExportTrello */
    protected $trello;

    /**
     * ExportFeedbackToTrello constructor.
     * @param ExportTrello $trello
     * @param $feedback
     * @param $doctrine
     */
    public function __construct(Export $export, $container)
    {
        parent::__construct($export, $container);
        $this->trello = $container->get('doctrine')->getRepository('FeedbackFieldBundle:ExportTrello')->findOneBy(array('export'=>$export));
    }

    protected function process(Feedback $feedback, ExportLog $exportLog)
    {

        $title = "FEEDBACK ". $feedback->getPublicId();

        if (!$this->client) {
            $this->client = new Client([
                'base_url'=>'https://trello.com/1/',
                'defaults'=>array(
                    'query'=>['key'=> $this->trello->getTrelloKey(),'token' => $this->trello->getTrelloToken()]
                )
            ]);
        }

        try {
            $response = $this->client->post(
                'cards/',
                ['query'=>array(
                    'idList'=>$this->trello->getTrelloListId(),
                    'name'=>$title,
                    'desc'=>$this->getTextOfAllContent($feedback),
                )]
            );

            if($response->getStatusCode() == 200) {
                $this->logDone($exportLog);
                return true;
            } else {
                $this->logRejected($exportLog);
                return false;
            }

        } catch (RequestException $e) {
            var_dump($e->getMessage());
            $this->logRejected($exportLog);
            return false;
        }



    }

}

