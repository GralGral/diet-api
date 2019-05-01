<?php


namespace App\Food\Infrastructure\Dish\Repository;


use App\Food\Domain\Dish\Dish;
use App\Food\Domain\Dish\Repository\DishRepositoryInterface;
use App\Shared\Infrastructure\EventSourcing\EventSourcingRepository;

class DishStore extends EventSourcingRepository implements DishRepositoryInterface
{
    /**
     * @param string $id
     *
     * @return Dish
     */
    public function get(string $id): Dish
    {
        // TODO: Implement get() method.
    }

    /**
     * @param Dish $dish
     */
    public function store(Dish $dish): void
    {
        $this->save($dish);
    }

    /**
     * @inheritDoc
     */
    protected function getAggregateClass(): string
    {
        return Dish::class;
    }
}