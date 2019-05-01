<?php

namespace App\Food\Domain\Meal\Repository;


use App\Food\Domain\Meal\Meal;

interface MealRepositoryInterface
{
    /**
     * @param string $id
     *
     * @return Meal
     */
    public function get(string $id): Meal;

    /**
     * @param Meal $dish
     */
    public function store(Meal $dish): void;
}