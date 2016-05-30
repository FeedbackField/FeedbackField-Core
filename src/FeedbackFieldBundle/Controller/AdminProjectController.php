<?php

namespace FeedbackFieldBundle\Controller;

use Doctrine\ORM\Mapping\Entity;

use FeedbackFieldBundle\Entity\FeedbackFieldDefinition;
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

/**
 *  @license 3-clause BSD
 *  @link https://github.com/FeedbackField/FeedbackField-Core
 */
class AdminProjectController extends Controller
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

    public function indexAction($projectId)
    {

        // build
        $return = $this->build($projectId);

        //data
        return $this->render('FeedbackFieldBundle:AdminProject:index.html.twig', array(
            'project'=>$this->project,
        ));

    }


    public function listFieldDefinitionsAction($projectId)
    {

        // build
        $return = $this->build($projectId);

        $doctrine = $this->getDoctrine()->getManager();
        $fields = $doctrine->getRepository('FeedbackFieldBundle:FeedbackFieldDefinition')->getForProject($this->project);

        //data
        return $this->render('FeedbackFieldBundle:AdminProject:listFieldDefinitions.html.twig', array(
            'project'=>$this->project,
            'feedbackFieldDefinitions'=>$fields,
            'feedbackFieldTypes'=>$this->container->get('feedback_field_type_finder')->getFieldTypes(),
        ));

    }


    public function listFeedbackAction($projectId, Request $request)
    {

        // build
        $this->build($projectId);

        $dateRange = new DateRange();
        $dateRange->setFromRequest($request);

        $doctrine = $this->getDoctrine()->getManager();
        $feedbacks = $doctrine->getRepository('FeedbackFieldBundle:Feedback')->getList($this->project, $dateRange);

        //data
        return $this->render('FeedbackFieldBundle:AdminProject:listFeedbacks.html.twig', array(
            'project' => $this->project,
            'feedbacks' => $feedbacks,
            'dateRange' => $dateRange,
        ));

    }

    public function statsFeedbackAction($projectId, Request $request)
    {

        // build
        $this->build($projectId);

        $dateRange = new DateRange();
        $dateRange->setFromRequest($request);

        $doctrine = $this->getDoctrine()->getManager();
        $count = $doctrine->getRepository('FeedbackFieldBundle:Feedback')->getCount($this->project, $dateRange);

        $fields = $doctrine->getRepository('FeedbackFieldBundle:FeedbackFieldDefinition')->getForProject($this->project);


        //data
        return $this->render('FeedbackFieldBundle:AdminProject:statsFeedbacks.html.twig', array(
            'project' => $this->project,
            'feedbackCount' => $count,
            'dateRange' => $dateRange,
            'feedbackFieldDefinitions'=>$fields,
            'feedbackFieldTypes'=>$this->container->get('feedback_field_type_finder')->getFieldTypes(),
        ));

    }


    public function listExportAction($projectId)
    {

        // build
        $return = $this->build($projectId);

        $doctrine = $this->getDoctrine()->getManager();
        $exports = $doctrine->getRepository('FeedbackFieldBundle:Export')->findBy(array('project'=>$this->project));

        //data
        return $this->render('FeedbackFieldBundle:AdminProject:listExports.html.twig', array(
            'project'=>$this->project,
            'exports'=>$exports,
        ));

    }
}
