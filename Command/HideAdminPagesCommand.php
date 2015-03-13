<?php

namespace Th3Mouk\CMSPageBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class HideAdminPagesCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('cms:hidePagesAdmin')
            ->setDescription('Hide system pages from page administration')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getEntityManager();

        $em->getRepository('ApplicationTh3MoukCMSPageBundle:Page')->pagesToHide();

        $output->writeln('OK');
    }

    public function getEntityManager()
    {
        return $this->getContainer()->get('doctrine')->getManager();
    }
}
