<?php

namespace FeedbackFieldBundle\Controller;

use Doctrine\ORM\Mapping\Entity;

use FeedbackFieldBundle\Entity\FeedbackFieldDefinition;
use FeedbackFieldBundle\Form\Type\AdminFeedbackFieldDefinitionNewType;
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
class AdminProjectFeedbackFieldDefinitionController extends Controller
{

    protected $project;

    protected $fieldDefinition;

    protected function build($projectId, $fieldDefinitionId)
    {
        $doctrine = $this->getDoctrine()->getManager();
        // load
        $projectRepo = $doctrine->getRepository('FeedbackFieldBundle:Project');
        $this->project = $projectRepo->findOneByPublicId($projectId);
        if (!$this->project) {
            throw new NotFoundHttpException();
        }
        // load
        $fieldDefinitionRepo = $doctrine->getRepository('FeedbackFieldBundle:FeedbackFieldDefinition');
        $this->fieldDefinition = $fieldDefinitionRepo->findOneBy(array('project'=>$this->project, 'publicId'=>$fieldDefinitionId));
        if (!$this->fieldDefinition) {
            throw new NotFoundHttpException();
        }
    }

    public function indexAction($projectId, $fieldDefinitionId)
    {

        // build
        $return = $this->build($projectId, $fieldDefinitionId);

        //data
        return $this->render('FeedbackFieldBundle:AdminFeedbackFieldDefinition:index.html.twig', array(
            'project'=>$this->project,
            'feedbackFieldDefinition' => $this->fieldDefinition,
            'feedbackFieldTypes'=>$this->container->get('feedback_field_type_finder')->getFieldTypes(),
        ));

    }

}

