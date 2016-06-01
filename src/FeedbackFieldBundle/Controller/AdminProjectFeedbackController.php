<?php

namespace FeedbackFieldBundle\Controller;

use Doctrine\ORM\Mapping\Entity;

use FeedbackFieldBundle\Entity\Feedback;
use FeedbackFieldBundle\Form\Type\AdminFeedbackNewType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use FeedbackFieldBundle\CSVHelper;
use FeedbackFieldBundle\Entity\Tag;
use FeedbackFieldBundle\Form\Type\AdminTagNewType;

/**
 *  @license 3-clause BSD
 *  @link https://github.com/FeedbackField/FeedbackField-Core
 */
class AdminProjectFeedbackController extends Controller
{

    protected $project;

    protected $feedback;

    protected function build($projectId, $feedbackId)
    {
        $doctrine = $this->getDoctrine()->getManager();
        // load
        $projectRepo = $doctrine->getRepository('FeedbackFieldBundle:Project');
        $this->project = $projectRepo->findOneByPublicId($projectId);
        if (!$this->project) {
            throw new NotFoundHttpException();
        }
        // load
        $feedbackRepo = $doctrine->getRepository('FeedbackFieldBundle:Feedback');
        $this->feedback = $feedbackRepo->findOneBy(array('project'=>$this->project, 'publicId'=>$feedbackId));
        if (!$this->feedback) {
            throw new NotFoundHttpException();
        }
    }

    public function indexAction($projectId, $feedbackId)
    {
        $doctrine = $this->getDoctrine()->getManager();

        // build
        $this->build($projectId, $feedbackId);

        $fields = array();
        foreach($doctrine->getRepository('FeedbackFieldBundle:FeedbackFieldDefinition')->getForProject($this->project) as $fieldDefinition) {
            $fieldType = $this->container->get('feedback_field_type_finder')->getFieldTypeById($fieldDefinition->getType());
            if ($fieldType) {
                $fieldValue = $fieldType->getFieldValue($this->feedback, $fieldDefinition);
                if ($fieldValue != null) {
                    $fields[] = array(
                        'field' => $fieldDefinition,
                        'valueString' => $fieldValue->getValueAsString($doctrine),
                        'subValuesString' => $fieldValue->getSubValuesAsString($doctrine),
                    );
                }
            }
        }

        //data
        return $this->render('FeedbackFieldBundle:AdminProjectFeedback:index.html.twig', array(
            'project'=>$this->project,
            'FeedbackFieldDefinitions'=>$fields,
            'feedback' => $this->feedback,
        ));

    }

}

