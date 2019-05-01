<?php

namespace App\Food\Infrastructure\Meal\Repository;


use App\Food\Domain\Meal\Meal;
use App\Food\Domain\Meal\Repository\MealRepositoryInterface;
use App\Shared\Infrastructure\EventSourcing\EventSourcingRepository;

class MealStore extends EventSourcingRepository implements MealRepositoryInterface
{
    /**
     * @param string $id
     *
     * @return Meal
     */
    public function get(string $id): Meal
    {
        // TODO: Implement get() method.
    }

    /**
     * @param Meal $meal
     */
    public function store(Meal $meal): void
    {
        $this->save($meal);
    }

    /**
     * @inheritdoc
     */
    public function getAggregateClass(): string
    {
        return Meal::class;
    }
}