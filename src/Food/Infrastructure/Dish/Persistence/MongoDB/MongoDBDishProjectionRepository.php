<?php


namespace App\Food\Infrastructure\Dish\Persistence\MongoDB;


use App\Food\Infrastructure\Dish\Persistence\Projection\DishProjection;
use App\Shared\Infrastructure\Persistence\MongoDB\MongoDBRepository;
use Doctrine\ODM\MongoDB\MongoDBException;
use function \array_key_first;

class MongoDBDishProjectionRepository extends MongoDBRepository
{
    /**
     * @param DishProjection $dish
     */
    public function add(DishProjection $dish): void
    {
        $this->register($dish);
    }

    /**
     * @param string $id
     *
     * @return DishProjection|null
     *
     * TODO Try to factorize these requests
     */
    public function findById(string $id): ?DishProjection
    {
        $results = $this->findByIds([$id]);

        return null !== ($key = array_key_first($results)) ? $results[$key] : null;
    }

    /**
     * @param array $ids
     *
     * @return array
     */
    public function findByIds(array $ids): array
    {
        try {
            return $this->repository
                ->createQueryBuilder()
                ->field('id')
                ->in($ids)
                ->getQuery()
                ->toArray();

        } catch (MongoDBException $exception) {
            // TODO: Add logs
            return [];
        }
    }

    /**
     * @inheritdoc
     */
    protected function getClass(): string
    {
        return DishProjection::class;
    }
}