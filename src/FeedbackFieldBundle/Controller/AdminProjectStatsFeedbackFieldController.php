<?php

namespace FeedbackFieldBundle\Controller;

use Doctrine\ORM\Mapping\Entity;

use FeedbackFieldBundle\Entity\FeedbackFieldDefinition;
use FeedbackFieldBundle\Entity\Project;
use FeedbackFieldBundle\FeedbackFieldTypeServiceInterface;
use FeedbackFieldBundle\Form\Type\AdminFeedbackFieldDefinitionNewType;
use FeedbackFieldBundle\Form\Type\AdminProjectFeedbackFieldDefinitionNewType;
use FeedbackFieldBundle\DateRange;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use FeedbackFieldBundle\CSVHelper;
use FeedbackFieldBundle\Entity\Tag;
use FeedbackFieldBundle\Form\Type\AdminTagNewType;
use Symfony\Component\Validator\Constraints\Date;

/**
 *  @license 3-clause BSD
 *  @link https://github.com/FeedbackField/FeedbackField-Core
 */
class AdminProjectStatsFeedbackFieldController extends Controller
{

    /** @var  Project */
    protected $project;

    /** @var FeedbackFieldDefinition */
    protected $feedbackFieldDefinition;

    /** @var DateRange */
    protected $dateRange;

    protected function build($projectId, $fieldDefinitionId, Request $request) {
        $doctrine = $this->getDoctrine()->getManager();
        // load
        $projectRepo = $doctrine->getRepository('FeedbackFieldBundle:Project');
        $this->project = $projectRepo->findOneByPublicId($projectId);
        if (!$this->project) {
            throw new NotFoundHttpException();
        }
        // load
        $this->feedbackFieldDefinition = $doctrine->getRepository('FeedbackFieldBundle:FeedbackFieldDefinition')->findOneBy(array('publicId'=>$fieldDefinitionId, 'project'=>$this->project));
        if (!$this->feedbackFieldDefinition) {
            throw new NotFoundHttpException();
        }
        // load
        $this->dateRange = new DateRange();
        $this->dateRange->setFromRequest($request);
    }

    public function indexAction($projectId, $fieldDefinitionId, Request $request)
    {

        // build
        $this->build($projectId, $fieldDefinitionId, $request);


        $doctrine = $this->getDoctrine()->getManager();
        $count = $doctrine->getRepository('FeedbackFieldBundle:Feedback')->getCount($this->project, $this->dateRange);

        /** @var FeedbackFieldTypeServiceInterface $fieldType */
        $fieldType = $this->container->get('feedback_field_type_finder')
            ->getFieldTypeById($this->feedbackFieldDefinition->getType());

        $countWithField = $fieldType->getCountWithFieldValue($this->project, $this->dateRange, $this->feedbackFieldDefinition);

        $moreFieldStatLinks = $fieldType->getFieldStatsLinks($this->project, $this->feedbackFieldDefinition);

        //data
        return $this->render('FeedbackFieldBundle:AdminProjectStatsFeedbackField:index.html.twig', array(
            'project' => $this->project,
            'feedbackFieldDefinition' => $this->feedbackFieldDefinition,
            'dateRange' => $this->dateRange,
            'feedbackCount' => $count,
            'feedbackCountWithField' => $countWithField,
            'moreFieldStatLinks' => $moreFieldStatLinks,
        ));

    }

}
