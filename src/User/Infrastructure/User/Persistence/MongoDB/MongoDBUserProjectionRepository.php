<?php

namespace App\User\Infrastructure\User\Persistence\MongoDB;


use App\Shared\Infrastructure\Persistence\MongoDB\MongoDBRepository;
use App\User\Infrastructure\User\Persistence\Projection\UserProjection;
use Doctrine\ODM\MongoDB\MongoDBException;
use function \array_key_first;


class MongoDBUserProjectionRepository extends MongoDBRepository
{
    /**
     * @param UserProjection $user
     */
    public function add(UserProjection $user): void
    {
        $this->register($user);
    }

    /**
     * @param string $id
     *
     * @return UserProjection|null
     */
    public function findById(string $id): ?UserProjection
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
     * @param array $criteria
     * @param array|null $pagination
     *
     * @return array
     */
    public function findByCriteria(array $criteria = [], array $pagination = null): array
    {
        $qb = $this->repository
            ->createQueryBuilder();

        foreach ($criteria as $criterion) {
            $qb->field($criterion['property'] ?? $criterion['name']);

            \is_array($value = $criterion['value']) ? $qb->in($value) : $qb->equals($value);
        }

        if (null !== $pagination) {
            $qb->skip($pagination['offset'])->limit($pagination['limit']);
        }

        return $qb
        ->getQuery()
        ->toArray();
    }

    /**
     * @return string
     */
    protected function getClass(): string
    {
        return UserProjection::class;
    }
}