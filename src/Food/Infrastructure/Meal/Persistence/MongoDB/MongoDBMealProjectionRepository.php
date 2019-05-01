<?php


namespace App\Food\Infrastructure\Meal\Persistence\MongoDB;


use App\Food\Infrastructure\Meal\Persistence\Projection\MealProjection;
use App\Shared\Infrastructure\Persistence\MongoDB\MongoDBRepository;
use Doctrine\ODM\MongoDB\MongoDBException;

use function \array_key_first;

class MongoDBMealProjectionRepository extends MongoDBRepository
{
    /**
     * @param MealProjection $meal
     */
    public function add(MealProjection $meal): void
    {
        $this->register($meal);
    }

    /**
     * @param string $id
     *
     * @return MealProjection|null
     *
     * TODO Try to factorize these requests
     */
    public function findById(string $id): ?MealProjection
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
        return MealProjection::class;
    }
}