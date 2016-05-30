<?php

namespace FeedbackFieldBundle\Controller;

use Doctrine\ORM\Mapping\Entity;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;


/**
 *  @license 3-clause BSD
 *  @link https://github.com/FeedbackField/FeedbackField-Core
 */
class IndexController extends Controller
{

  	public function indexAction()
  	{


      return $this->render('FeedbackFieldBundle:Index:index.html.twig', array(
      ));


    }

  	public function youAction()
  	{


      return $this->render('FeedbackFieldBundle:Index:you.html.twig', array(
      ));


    }

}
