<?php
namespace LegoCue\Framework;

use Symfony\Component\Console\CommandLoader\ContainerCommandLoader;
use Symfony\Component\Console\Application as SymfonyApplication ;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use LegoCue\Framework\Kernel;
use LegoCue\Framework\Exception\LegoException;

class Application extends SymfonyApplication
{
    /**
     * @var LegoCue\Framework\Kernel
     */
    private $_commands = null;

    /**
     * entry function
     */
    public function terminate( InputInterface $input = null, OutputInterface $output = null )
    {
        if( is_null( $this->_commands ) || !($this->_commands instanceof Kernel ) )
        {
            throw new LegoException( 'commonds not loaded' );
        }

        $commandLoader = new ContainerCommandLoader(
            $this->_commands->getContainer(),
            $this->_commands->getMaps()
        );
        $this->setCommandLoader( $commandLoader );
        $this->run( $input, $output );
    }

    /**
     * load commands-kernel class
     */
    public function loadCommands( Kernel $commands )
    {
        $this->_commands = $commands;
    }
}