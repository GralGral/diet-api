<?php


namespace App\Food\Application\Meal\Command\Find;


use App\Food\Infrastructure\Meal\Persistence\MongoDB\MongoDBMealProjectionRepository;
use App\Food\Infrastructure\Meal\Persistence\Projection\MealProjection;
use App\Shared\Application\Query\QueryHandlerInterface;

class FindMealHandler implements QueryHandlerInterface
{
    /**
     * @var MongoDBMealProjectionRepository
     */
    private $repository;

    public function __construct(MongoDBMealProjectionRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param FindMealQuery $query
     *
     * @return MealProjection|null
     */
    public function __invoke(FindMealQuery $query): ?MealProjection
    {
        return $this->repository->findById($query->getId());
    }
}