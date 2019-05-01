<?php

declare(strict_types=1);

namespace App\User\Application\User\Query\Find;


use App\User\Infrastructure\User\Persistence\MongoDB\MongoDBUserProjectionRepository;
use App\User\Infrastructure\User\Persistence\Projection\UserProjection;
use App\Shared\Application\Query\QueryHandlerInterface;
use Doctrine\ORM\NonUniqueResultException;

class FindUserHandler implements QueryHandlerInterface
{
    /**
     * @var MongoDBUserProjectionRepository
     */
    private $repository;

    public function __construct(MongoDBUserProjectionRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param FindUserQuery $query
     *
     * @return UserProjection|null
     */
    public function __invoke(FindUserQuery $query): ?UserProjection
    {
        return $this->repository->findById((string) $query->getId());
    }
}