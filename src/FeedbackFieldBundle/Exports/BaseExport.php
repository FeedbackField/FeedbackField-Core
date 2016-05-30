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
abstract class BaseExport
{

    /** @var  Export */
    protected $export;

    protected $container;

    /** @var Client **/
    protected $client;

    /**
     * @param $feedback
     * @param $doctrine
     */
    public function __construct(Export $export, $container)
    {
        $this->export = $export;
        $this->container = $container;
    }

    public function go(Feedback $feedback) {
        $exportLog = $this->getLog($feedback);

        if (!$this->isLogMarkedDone($exportLog) && $this->shouldExportThisFeedback($feedback)) {
            $this->process($feedback, $exportLog);
        }
    }

    protected abstract function process(Feedback $feedback, ExportLog $exportLog);

    protected function getTextOfAllContent(Feedback $feedback) {

        $out = '';


        foreach($this->container->get('doctrine')->getRepository('FeedbackFieldBundle:FeedbackFieldDefinition')->getForProject($feedback->getProject()) as $fieldDefinition) {


            $fieldType = $this->container->get('feedback_field_type_finder')->getFieldTypeById($fieldDefinition->getType());

            if ($fieldType) {

                $value = $fieldType->getFieldValue($feedback, $fieldDefinition);

                if ($value) {
                    $out .= 'Field: ' . $fieldDefinition->getTitle() . "\n";

                    $out .= $value->getValueAsString($this->container->get('doctrine')) . "\n";

                    $out .= "\n\n";
                }

            }

        }

        return $out;

    }

    protected function shouldExportThisFeedback(Feedback $feedback) {

        $export = true;


        foreach($this->container->get('doctrine')->getRepository('FeedbackFieldBundle:ExportOnlyIfFeedbackField')->findBy(array('export'=>$this->export)) as $exportOnlyIfFeedbackField) {

            $fieldType = $this->container->get('feedback_field_type_finder')->getFieldTypeById($exportOnlyIfFeedbackField->getFeedbackFieldDefinition()->getType());

            if ($fieldType) {

                $value = $fieldType->getFieldValue($feedback, $exportOnlyIfFeedbackField->getFeedbackFieldDefinition());
                if (is_null($value)) {
                    $export = false;
                }

            }

        }

        return $export;

    }

    protected function isLogMarkedDone(ExportLog $exportLog) {
        return (boolean)$exportLog->getRejectedAt() || (boolean)$exportLog->getDoneAt();
    }

    protected function getLog(Feedback $feedback) {
        $repo = $this->container->get('doctrine')->getRepository('FeedbackFieldBundle:ExportLog');
        $log = $repo->findOneBy(array(
            'feedback'=>$feedback,
            'export'=>$this->trello,
        ));
        if (!$log) {
            $log = new ExportLog();
            $log->setExport($this->export);
            $log->setFeedback($feedback);
            $this->container->get('doctrine')->persist($log);
            $this->container->get('doctrine')->flush();
        }
        return $log;
    }

    protected function logRejected(ExportLog $exportLog) {
        $exportLog->setRejectedAt(new \DateTime("", new \DateTimeZone("UTC")));
        $this->container->get('doctrine')->persist($exportLog);
        $this->container->get('doctrine')->flush();
    }

    protected function logDone(ExportLog $exportLog) {
        $exportLog->setDoneAt(new \DateTime("", new \DateTimeZone("UTC")));
        $this->container->get('doctrine')->persist($exportLog);
        $this->container->get('doctrine')->flush();
    }

}
