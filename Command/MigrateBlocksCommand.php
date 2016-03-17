<?php

/*
 * (c) Jérémy Marodon <marodon.jeremy@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Th3Mouk\CMSPageBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MigrateBlocksCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('cms:block:migrate')
            ->setDescription('Migrate block datas from v1.x to v2.x')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->getContainer()->get('cms.block.migrate')->migrateCkeditorBlocks();

        $output->writeln('Migration complete');
    }
}
