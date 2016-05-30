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

    public function indexAction($projectId, Request $request)
    {
        $doctrine = $this->getDoctrine()->getManager();

        $fieldTypes = $this->container->get('feedback_field_type_finder')->getFieldTypes();

        // build
        $this->build($projectId);

        $feedback = new Feedback();
        $feedback->setProject($this->project);
        $objectsToSave = array( );

        foreach($doctrine->getRepository('FeedbackFieldBundle:FeedbackFieldDefinition')->getForProject($this->project) as $field) {
            if (isset($fieldTypes[$field->getType()])) {
                $feedbackFieldValue = $fieldTypes[$field->getType()]->getNewValueEntity();
                $feedbackFieldValue->setFeedbackFieldDefinition($field);
                $feedbackFieldValue->setFeedback($feedback);
                if ($field->getIsAutoFill()) {
                    if ($feedbackFieldValue->setAutoFilledValueFromAPI1($request)) {
                        $objectsToSave[] = $feedbackFieldValue;
                    }
                } else {
                    $value = $request->get($field->getPublicId(), null);
                    if ($feedbackFieldValue->setValueFromAPI1($value)) {
                        $objectsToSave[] = $feedbackFieldValue;
                    }
                }
            }
        }

        if (count($objectsToSave) > 0) {
            $doctrine->persist($feedback);
            $doctrine->flush($feedback);
            foreach($objectsToSave as $objectToSave) {
                $doctrine->persist($objectToSave);
            }
            $doctrine->flush($objectsToSave);
        }


        $response = new Response(json_encode(array()));
        $response->headers->set('Content-Type', 'application/json');
        return $response;

    }

}
