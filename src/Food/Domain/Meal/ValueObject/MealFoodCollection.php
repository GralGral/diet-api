<?php


namespace App\Food\Domain\Meal\ValueObject;


use App\Shared\Domain\Collection;

class MealFoodCollection extends Collection
{
    /**
     * @return string
     */
    public function getClass(): string
    {
        return MealFood::class;
    }
}