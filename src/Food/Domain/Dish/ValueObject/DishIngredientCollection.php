<?php


namespace App\Food\Domain\Dish\ValueObject;


use App\Shared\Domain\Collection;

class DishIngredientCollection extends Collection
{
    /**
     * @inheritDoc
     */
    public function getClass(): string
    {
        return DishIngredient::class;
    }
}