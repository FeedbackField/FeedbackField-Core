<?php

namespace FeedbackFieldBundle\Controller;

use Doctrine\ORM\Mapping\Entity;

use FeedbackFieldBundle\Entity\Feedback;
use FeedbackFieldBundle\Entity\FeedbackFieldValueBrowserUserAgent;
use FeedbackFieldBundle\Entity\FeedbackFieldValueString;
use FeedbackFieldBundle\Entity\FeedbackFieldValueText;
use FeedbackFieldBundle\Entity\FeedbackFieldDefinition;
use FeedbackFieldBundle\Entity\FeedbackFieldValueURL;
use FeedbackFieldBundle\Form\Type\AdminFeedbackFieldDefinitionNewType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use FeedbackFieldBundle\CSVHelper;
use FeedbackFieldBundle\Entity\Tag;
use FeedbackFieldBundle\Form\Type\AdminTagNewType;

/**
 *  @license 3-clause BSD
 *  @link https://github.com/FeedbackField/FeedbackField-Core
 */
class API1ProjectController extends Controller
{

    protected $project;


    protected function build($projectId) {
        $doctrine = $this->getDoctrine()->getManager();
        // load
        $projectRepo = $doctrine->getRepository('FeedbackFieldBundle:Project');
        $this->project = $projectRepo->findOneByPublicId($projectId);
        if (!$this->project) {
            throw new NotFoundHttpException();
        }
    }

    public function submitAction($projectId, Request $request)
    {
        return $this->submitJSONAction($projectId, $request);
    }

    public function submitJSONAction($projectId, Request $request) {

        $out = $this->submit($projectId, $request);

        $response = new Response(json_encode($out));
        $response->headers->set('Content-Type', 'application/json');
        return $response;

    }

    public function submitJSONPAction($projectId, Request $request) {

        $out = $this->submit($projectId, $request);

        $callbackFunc = $request->get('callback', 'callback');

        $response = new Response($callbackFunc."(".json_encode($out).")");
        $response->headers->set('Content-Type', 'text/javascript');
        return $response;

    }

    protected function submit($projectId, Request $request)
    {
        $doctrine = $this->getDoctrine()->getManager();

        $fieldTypes = $this->container->get('feedback_field_type_finder')->getFieldTypes();

        // build
        $this->build($projectId);

        $feedback = new Feedback();
        $feedback->setProject($this->project);
        $fieldsToSave = array( );

        foreach($doctrine->getRepository('FeedbackFieldBundle:FeedbackFieldDefinition')->getForProject($this->project) as $fieldDefinition) {
            if (isset($fieldTypes[$fieldDefinition->getType()])) {
                $feedbackFieldValue = $fieldTypes[$fieldDefinition->getType()]->getNewValueEntity();
                $feedbackFieldValue->setFeedbackFieldDefinition($fieldDefinition);
                $feedbackFieldValue->setFeedback($feedback);
                if ($fieldDefinition->getIsAutoFill()) {
                    if ($feedbackFieldValue->setAutoFilledValueFromAPI1($request)) {
                        $fieldsToSave[$fieldDefinition->getPublicId()] = $feedbackFieldValue;
                    }
                } else {
                    $value = $request->get($fieldDefinition->getPublicId(), null);
                    if ($feedbackFieldValue->setValueFromAPI1($value)) {
                        $fieldsToSave[$fieldDefinition->getPublicId()] = $feedbackFieldValue;
                    }
                }
            }
        }

        if (count($fieldsToSave) > 0) {
            # Save Actual Feedback to DataBase
            $doctrine->persist($feedback);
            $doctrine->flush($feedback);
            # Save Any Fields to DataBase
            foreach($fieldsToSave as $fieldToSave) {
                $doctrine->persist($fieldToSave);
            }
            $doctrine->flush($fieldsToSave);
            # Call any fields Post save
            foreach($doctrine->getRepository('FeedbackFieldBundle:FeedbackFieldDefinition')->getForProject($this->project) as $fieldDefinition) {
                if (isset($fieldTypes[$fieldDefinition->getType()]) && isset($fieldsToSave[$fieldDefinition->getPublicId()])) {
                    if ($fieldTypes[$fieldDefinition->getType()]->callPostPersistForField($this->project, $fieldDefinition, $fieldsToSave[$fieldDefinition->getPublicId()])) {
                        $doctrine->persist($fieldsToSave[$fieldDefinition->getPublicId()]);
                        $doctrine->flush($fieldsToSave[$fieldDefinition->getPublicId()]);
                    }
                }
            }
        }

        $out = array();

        // For Debug you may want to use these?
        //$out['memory_get_peak_usage_false'] = memory_get_peak_usage(false);
        //$out['memory_get_peak_usage_true'] = memory_get_peak_usage(true);
        //$out['memory_get_usage_false'] = memory_get_usage(false);
        //$out['memory_get_usage_true'] = memory_get_usage(true);

        return $out;

    }

}
