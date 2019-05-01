<?php

namespace App\Food\Domain\Dish\Repository;


use App\Food\Domain\Dish\Dish;

interface DishRepositoryInterface
{
    /**
     * @param string $id
     *
     * @return Dish
     */
    public function get(string $id): Dish;

    /**
     * @param Dish $dish
     */
    public function store(Dish $dish): void;
}