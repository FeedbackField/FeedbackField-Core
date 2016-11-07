<?php

namespace FeedbackFieldBundle\Command;


use FeedbackFieldBundle\AnonymiseFeedback;
use FeedbackFieldBundle\Entity\Project;
use FeedbackFieldBundle\Exports\ExportFeedbackToTrello;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 *  @license 3-clause BSD
 *  @link https://github.com/FeedbackField/FeedbackField-Core
 */
class ProcessCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this
            ->setName('FeedbackField:process')
            ->setDescription('Process');

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $doctrine = $this->getContainer()->get('doctrine')->getManager();
        $projectRepo = $doctrine->getRepository('FeedbackFieldBundle:Project');
        foreach ($projectRepo->findAll() as $project) {
            $output->writeln("Project ".$project->getPublicId());
            $this->processProject($project, $output);
        }
        $output->writeln('Done');

    }


    protected function processProject(Project $project, OutputInterface $output) {


        $doctrine = $this->getContainer()->get('doctrine')->getManager();

        // ############### Feedbacks
        $feedbackRepo = $doctrine->getRepository('FeedbackFieldBundle:Feedback');
        $feedbacks = $feedbackRepo->findBy(array('project'=>$project));

        foreach($feedbacks as $feedback) {

            $output->writeln('- Feedback ID '. $feedback->getPublicId());

            foreach($project->getExports() as $export) {


                $output->writeln('- - Export ID '. $export->getPublicId());

                if (!$export->getIsActive()) {

                    $output->writeln('- - - Is not active');

                } else if ($export->isTypeTrello()) {

                    $output->writeln('- - - Trello');
                    $exportFeedbackToTrello = new ExportFeedbackToTrello($export, $this->getContainer());
                    if ($exportFeedbackToTrello->go($feedback)) {
                        $output->writeln('- - - - Done!');
                    } else {
                        $output->writeln('- - - - Not Done');
                    }

                }


            }


        }

        unset($feedbacks);

        // ############### Anon

        $feedbackFieldDefRepo = $doctrine->getRepository('FeedbackFieldBundle:FeedbackFieldDefinition');

        foreach($feedbackFieldDefRepo->getForProject($project) as $fieldDefinition) {

            if ($fieldDefinition->getAnonymiseAfterDays() > 0) {

                $output->writeln('- Anon Field ID '. $fieldDefinition->getPublicId());

                $fieldType = $this->getContainer()->get('feedback_field_type_finder')->getFieldTypeById($fieldDefinition->getType());
                $fieldType->anonymiseFieldContents($project, $fieldDefinition);
            }

        }

    }

}
