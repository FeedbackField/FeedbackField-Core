<?php

namespace FeedbackFieldTypeBrowserUserAgentBundle\Command;


use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 *  @license 3-clause BSD
 *  @link https://github.com/FeedbackField/FeedbackField-Core
 */
class UpdateBrowsCapCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this
            ->setName('FeedbackField:updateBrowseCap')
            ->setDescription('updateBrowseCap');

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $this->getContainer()->get('browscap')->getBrowsCap()->updateCache();

        $output->writeln('Done');

    }

}
