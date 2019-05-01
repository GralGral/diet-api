<?php


namespace App\Food\Application\Dish\Query\Find;


use App\Food\Infrastructure\Dish\Persistence\MongoDB\MongoDBDishProjectionRepository;
use App\Food\Infrastructure\Dish\Persistence\Projection\DishProjection;
use App\Shared\Application\Query\QueryHandlerInterface;

class FindDishHandler implements QueryHandlerInterface
{
    /**
     * @var MongoDBDishProjectionRepository
     */
    private $repository;

    public function __construct(MongoDBDishProjectionRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param FindDishQuery $query
     *
     * @return DishProjection|null
     */
    public function __invoke(FindDishQuery $query): ?DishProjection
    {
        return $this->repository->findById((string) $query->getId());
    }
}