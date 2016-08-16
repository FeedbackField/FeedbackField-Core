<?php

namespace FeedbackFieldTypeStringBundle\Controller;

use Doctrine\ORM\Mapping\Entity;

use FeedbackFieldBundle\Controller\AdminProjectStatsFeedbackFieldController;
use FeedbackFieldBundle\Form\Type\AdminFeedbackFieldDefinitionNewType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use FeedbackFieldBundle\Entity\Tag;
use FeedbackFieldBundle\Form\Type\AdminTagNewType;

/**
 *  @license 3-clause BSD
 *  @link https://github.com/FeedbackField/FeedbackField-Core
 */
class AdminProjectStatsFeedbackFieldStringController extends AdminProjectStatsFeedbackFieldController
{

    protected function build($projectId, $fieldDefinitionId, Request $request)
    {
        parent::build($projectId, $fieldDefinitionId, $request);
        if ($this->feedbackFieldDefinition->getType() != 'string') {
            throw new NotFoundHttpException();
        }
    }

    public function enumAction($projectId, $fieldDefinitionId, Request $request)
    {

        // build
        $this->build($projectId, $fieldDefinitionId, $request);


        $doctrine = $this->getDoctrine()->getManager();
        $data = $doctrine->getRepository('FeedbackFieldTypeStringBundle:FeedbackFieldValueString')->getEnum($this->project, $this->dateRange, $this->feedbackFieldDefinition);


        //data
        return $this->render('FeedbackFieldTypeStringBundle:AdminProjectStatsFeedbackFieldString:enum.html.twig', array(
            'project' => $this->project,
            'feedbackFieldDefinition' => $this->feedbackFieldDefinition,
            'dateRange' => $this->dateRange,
            'data' => $data,
        ));

    }

}

