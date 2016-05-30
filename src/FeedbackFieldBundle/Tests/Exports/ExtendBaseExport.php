<?php

namespace FeedbackFieldBundle\Tests\Exports;

use FeedbackFieldBundle\Entity\Export;
use FeedbackFieldBundle\Entity\ExportLog;
use FeedbackFieldBundle\Entity\Feedback;
use FeedbackFieldBundle\Exports\BaseExport;

/**
 *  @license 3-clause BSD
 *  @link https://github.com/FeedbackField/FeedbackField-Core
 */
class ExtendBaseExport extends BaseExport
{


    /**
     * ExportFeedbackToTrello constructor.
     * @param $export
     * @param $container
     */
    public function __construct(Export $export, $container)
    {
        parent::__construct($export, $container);
    }

    public function extendGetTextOfAllContent(Feedback $feedback)
    {
        return $this->getTextOfAllContent($feedback);
    }

    public function extendShouldExportThisFeedback(Feedback $feedback) {
        return $this->shouldExportThisFeedback($feedback);
    }

    protected function process(Feedback $feedback, ExportLog $exportLog) {

    }


}

