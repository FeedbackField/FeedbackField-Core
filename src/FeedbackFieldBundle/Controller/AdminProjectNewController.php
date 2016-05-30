<?php

namespace FeedbackFieldBundle\Controller;

use Doctrine\ORM\Mapping\Entity;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use FeedbackFieldBundle\Entity\Project;
use FeedbackFieldBundle\Form\Type\AdminProjectNewType;

/**
 *  @license 3-clause BSD
 *  @link https://github.com/FeedbackField/FeedbackField-Core
 */
class AdminProjectNewController extends Controller
{

  	public function indexAction()
  	{

          $doctrine = $this->getDoctrine()->getManager();

          $form = $this->createForm(new AdminProjectNewType());
          $request = $this->getRequest();
          if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
              $project = new Project();
              $project->setPublicId($form->get('publicId')->getData());
              $project->setTitle($form->get('title')->getData());
              $project->setActive(true);
              $project->setOwner($this->getUser());
              $doctrine->persist($project);
              $doctrine->flush();
              return $this->redirect($this->generateUrl('feedbackfield_admin_project_show', array('projectId'=>$project->getPublicId())));
            }
          }

          return $this->render('FeedbackFieldBundle:AdminProjectNew:index.html.twig', array(
            'form' => $form->createView(),
          ));


    }

}
