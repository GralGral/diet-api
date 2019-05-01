<?php

namespace App\Shared\Infrastructure\EventSourcing;


use Broadway\EventHandling\EventBus;
use Broadway\EventSourcing\AggregateFactory\PublicConstructorAggregateFactory;
use Broadway\EventSourcing\EventSourcingRepository as BroadwayEventSourcingRepository;
use Broadway\EventStore\EventStore;

class EventSourcingRepository extends BroadwayEventSourcingRepository
{
    public function __construct(
        EventStore $eventStore,
        EventBus $eventBus,
        $eventStreamDecorators = []
    ) {
        parent::__construct(
            $eventStore,
            $eventBus,
            $this->getAggregateClass(),
            new PublicConstructorAggregateFactory(),
            $eventStreamDecorators
        );
    }

    /**
     * @return string
     */
    protected function getAggregateClass(): string
    {
        throw new \LogicException(sprintf(
            "Method %s must be override in % class",
            __METHOD__,
            \get_class($this)
        ));
    }
}