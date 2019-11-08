<?php

namespace LegoCue\Framework;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Psr\Container\ContainerInterface;

class Kernel
{
    /**
     * regist commands
     */
    protected $commands = [];

    /**
     * 
     */
    public function getMaps(): array
    {
        $maps = [];
        foreach ($this->commands as $command) {
            $maps[(new $command)->getName()] = $command;
        }
        return $maps;
    }

    /**
     * get a psr11 container
     * the command defaultly is public
     */
    public function getContainer(): ContainerInterface
    {
        $containerBuilder = new ContainerBuilder();
        foreach ($this->commands as $command) {
            $containerBuilder->register($command, $command)
                ->addTag('console.command')
                ->setPublic(true);
        }
        $containerBuilder->compile();
        return $containerBuilder;
    }
}
