<?php

namespace FeedbackFieldBundle\Controller;

use Doctrine\ORM\Mapping\Entity;

use FeedbackFieldBundle\Entity\Export;
use FeedbackFieldBundle\Entity\ExportTrello;
use FeedbackFieldBundle\Entity\FeedbackFieldDefinition;
use FeedbackFieldBundle\Form\Type\AdminProjectExportTrelloNewType;
use FeedbackFieldBundle\Form\Type\AdminProjectFeedbackFieldDefinitionNewType;

/**
 *  @license 3-clause BSD
 *  @link https://github.com/FeedbackField/FeedbackField-Core
 */
class AdminProjectEditController extends AdminProjectController
{



    public function newExportTrelloAction($projectId)
    {

        // build
        $return = $this->build($projectId);


        $doctrine = $this->getDoctrine()->getManager();

        $export = new Export();
        $export->setProject($this->project);
        $export->setType('TRELLO');
        $exportTrello = new ExportTrello();
        $exportTrello->setExport($export);
        $form = $this->createForm(new AdminProjectExportTrelloNewType());
        $request = $this->getRequest();
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $exportTrello->setTrelloKey($form->get('key')->getData());
                $exportTrello->setTrelloToken($form->get('token')->getData());
                $exportTrello->setTrelloListId($form->get('list_id')->getData());
                $doctrine->persist($export);
                $doctrine->flush();
                $doctrine->persist($exportTrello);
                $doctrine->flush();
                return $this->redirect($this->generateUrl('feedbackfield_admin_project_export_show', array(
                    'projectId'=>$this->project->getPublicId(),
                    'exportId'=>$export->getPublicId(),
                )));
            }
        }

        //data
        return $this->render('FeedbackFieldBundle:AdminProjectEdit:newExportTrello.html.twig', array(
            'project'=>$this->project,
            'form'=>$form->createView(),
        ));

    }



    public function newFeedbackFieldDefinitionAction($projectId)
    {

        // build
        $return = $this->build($projectId);


        $doctrine = $this->getDoctrine()->getManager();

        $FeedbackFieldDefinition = new FeedbackFieldDefinition();
        $FeedbackFieldDefinition->setProject($this->project);
        $FeedbackFieldDefinition->setAddedBy($this->getUser());
        $form = $this->createForm(new AdminProjectFeedbackFieldDefinitionNewType($this->container), $FeedbackFieldDefinition);
        $request = $this->getRequest();
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $FeedbackFieldDefinition->setSort($doctrine->getRepository('FeedbackFieldBundle:FeedbackFieldDefinition')->getNextSortOrderForNewFieldOnProject($this->project));
                $doctrine->persist($FeedbackFieldDefinition);
                $doctrine->flush();
                return $this->redirect($this->generateUrl('feedbackfield_admin_project_feedback_field_definition_show', array(
                    'projectId'=>$this->project->getPublicId(),
                    'fieldDefinitionId'=>$FeedbackFieldDefinition->getPublicId(),
                )));
            }
        }

        //data
        return $this->render('FeedbackFieldBundle:AdminProjectEdit:newFeedbackFieldDefinition.html.twig', array(
            'project'=>$this->project,
            'form'=>$form->createView(),
        ));

    }




}