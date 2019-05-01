<?php

namespace App\Food\Infrastructure\Food\Repository;


use App\Food\Domain\Food\Food;
use App\Food\Domain\Food\Repository\FoodRepositoryInterface;
use App\Shared\Infrastructure\EventSourcing\EventSourcingRepository;

class FoodStore extends EventSourcingRepository implements FoodRepositoryInterface
{
    /**
     * @param string $id
     *
     * @return Food
     */
    public function get(string $id): Food
    {
        // TODO: Implement get() method.
    }

    /**
     * @param Food $food
     */
    public function store(Food $food): void
    {
        $this->save($food);
    }

    /**
     * @inheritdoc
     */
    public function getAggregateClass(): string
    {
        return Food::class;
    }
}