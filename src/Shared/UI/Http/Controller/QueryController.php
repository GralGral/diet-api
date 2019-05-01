<?php

namespace App\Shared\UI\Http\Controller;


use League\Tactician\CommandBus;

abstract class QueryController
{
    /**
     * @var CommandBus
     */
    private $queryBus;

    public function __construct(CommandBus $queryBus)
    {
        $this->queryBus = $queryBus;
    }

    protected function query($query)
    {
        return $this->queryBus->handle($query);
    }
}