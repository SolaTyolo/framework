<?php
namespace LegoCue\Framework;

use Symfony\Component\Console\CommandLoader\ContainerCommandLoader;
use Symfony\Component\Console\Application as SymfonyApplication ;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use LegoCue\Framework\Kernel;

class Application extends SymfonyApplication
{
    public function terminate( InputInterface $input = null, OutputInterface $output = null )
    {
        $kernel = new Kernel();
        $commandLoader = new ContainerCommandLoader(
            $kernel->getContainer(),
            $kernel->getMaps()
        );
        $this->setCommandLoader( $commandLoader );
        $this->run( $input, $output );
    }
}