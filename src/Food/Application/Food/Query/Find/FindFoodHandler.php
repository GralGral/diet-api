<?php

namespace App\Food\Application\Food\Query\Find;


use App\Food\Infrastructure\Food\Persistence\MongoDB\MongoDBFoodProjectionRepository;
use App\Food\Infrastructure\Food\Persistence\Projection\FoodProjection;
use App\Shared\Application\Query\QueryHandlerInterface;
use Doctrine\ORM\NonUniqueResultException;

class FindFoodHandler implements QueryHandlerInterface
{
    /**
     * @var MongoDBFoodProjectionRepository
     */
    private $repository;

    public function __construct(MongoDBFoodProjectionRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param FindFoodQuery $query
     *
     * @return FoodProjection|null
     */
    public function __invoke(FindFoodQuery $query): ?FoodProjection
    {
        return $this->repository->findById((string) $query->getId());
    }
}