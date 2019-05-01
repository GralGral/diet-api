<?php

namespace App\User\Infrastructure\User\Persistence;


use App\User\Domain\User\Event\UserCreatedEvent;
use App\User\Infrastructure\User\Persistence\MongoDB\MongoDBUserProjectionRepository;
use App\User\Infrastructure\User\Persistence\Projection\UserProjection;
use Broadway\ReadModel\Projector;

class UserProjector extends Projector
{
    /**
     * @var MongoDBUserProjectionRepository
     */
    private $repository;

    /**
     * UserProjectionFactory constructor.
     *
     * @param MongoDBUserProjectionRepository $repository
     */
    public function __construct(MongoDBUserProjectionRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param UserCreatedEvent $event
     */
    protected function applyUserCreatedEvent(UserCreatedEvent $event): void
    {
        $user = new UserProjection(
            $event->getId(),
            $event->getFirstname(),
            $event->getLastname(),
            $event->getCredentials()
        );

        $this->repository->add($user);
    }

}