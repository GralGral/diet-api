<?php

namespace App\Food\Domain\Meal\ValueObject;


use App\Shared\Domain\Collection;

class MealDishCollection extends Collection
{
    /**
     * @return string
     */
    public function getClass(): string
    {
        return MealDish::class;
    }
}