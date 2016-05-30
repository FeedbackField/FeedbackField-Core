<?php

namespace FeedbackFieldBundle\Controller;

use Doctrine\ORM\Mapping\Entity;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;


/**
 *  @license 3-clause BSD
 *  @link https://github.com/FeedbackField/FeedbackField-Core
 */
class AdminProjectListController extends Controller
{

  	public function indexAction()
  	{

      $doctrine = $this->getDoctrine()->getManager();
      $projectsRepo = $doctrine->getRepository('FeedbackFieldBundle:Project');
      $projects = $projectsRepo->findAll();

      return $this->render('FeedbackFieldBundle:AdminProjectList:index.html.twig', array(
        'projects'=>$projects,
      ));

    }

}
