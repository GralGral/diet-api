<?php

namespace App\Shared\UI\Http\Controller;


use League\Tactician\CommandBus;

abstract class CommandController
{
    /**
     * @var CommandBus
     */
    private $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    protected function exec($command)
    {
        return $this->commandBus->handle($command);
    }
}