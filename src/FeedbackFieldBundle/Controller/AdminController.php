<?php

namespace FeedbackFieldBundle\Controller;

use Doctrine\ORM\Mapping\Entity;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;


/**
 *  @license 3-clause BSD
 *  @link https://github.com/FeedbackField/FeedbackField-Core
 */
class AdminController extends Controller
{

  	public function indexAction()
  	{


      return $this->render('FeedbackFieldBundle:Admin:index.html.twig', array(
      ));


    }

}
