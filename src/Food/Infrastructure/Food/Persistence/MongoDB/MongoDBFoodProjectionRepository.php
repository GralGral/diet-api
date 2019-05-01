<?php

namespace App\Food\Infrastructure\Food\Persistence\MongoDB;


use App\Food\Infrastructure\Food\Persistence\Projection\FoodProjection;
use App\Shared\Infrastructure\Persistence\MongoDB\MongoDBRepository;
use Doctrine\ODM\MongoDB\MongoDBException;
use function \array_key_first;

class MongoDBFoodProjectionRepository extends MongoDBRepository
{
    /**
     * @param FoodProjection $food
     */
    public function add(FoodProjection $food): void
    {
        $this->register($food);
    }

    /**
     * @param string $id
     *
     * @return FoodProjection|null
     */
    public function findById(string $id): ?FoodProjection
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
        return FoodProjection::class;
    }
}