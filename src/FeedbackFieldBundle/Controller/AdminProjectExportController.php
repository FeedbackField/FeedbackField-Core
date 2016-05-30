<?php

namespace FeedbackFieldBundle\Controller;


use FeedbackFieldBundle\Form\Type\AdminExportNewType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use FeedbackFieldBundle\Entity\Tag;
use FeedbackFieldBundle\Form\Type\AdminTagNewType;

/**
 *  @license 3-clause BSD
 *  @link https://github.com/ExportField/ExportField-Core
 */
class AdminProjectExportController extends Controller
{

    protected $project;

    protected $export;

    protected function build($projectId, $exportId)
    {
        $doctrine = $this->getDoctrine()->getManager();
        // load
        $projectRepo = $doctrine->getRepository('FeedbackFieldBundle:Project');
        $this->project = $projectRepo->findOneByPublicId($projectId);
        if (!$this->project) {
            throw new NotFoundHttpException();
        }
        // load
        $exportRepo = $doctrine->getRepository('FeedbackFieldBundle:Export');
        $this->export = $exportRepo->findOneBy(array('project'=>$this->project, 'publicId'=>$exportId));
        if (!$this->export) {
            throw new NotFoundHttpException();
        }
    }

    public function indexAction($projectId, $exportId)
    {
        $doctrine = $this->getDoctrine()->getManager();


        // build
        $this->build($projectId, $exportId);


        $onlyIfFeedbackFields = $doctrine->getRepository('FeedbackFieldBundle:ExportOnlyIfFeedbackField')->findBy(array('export'=>$this->export));

        //data
        return $this->render('FeedbackFieldBundle:AdminProjectExport:index.html.twig', array(
            'project'=>$this->project,
            'export' => $this->export,
            'onlyIfFeedbackFields'=> $onlyIfFeedbackFields,
            'feedbackFieldTypes'=>$this->container->get('feedback_field_type_finder')->getFieldTypes(),
        ));

    }

}

