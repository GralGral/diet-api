<?php

namespace App\Food\Domain\Dish\ValueObject;


use App\Food\Domain\Shared\ValueObject\FoodId;

final class DishIngredient
{
    /**
     * @var DishIngredientQuantity
     */
    private $quantity;

    /**
     * @var FoodId
     */
    private $foodId;

    /**
     * DishIngredient constructor.
     *
     * @param DishIngredientQuantity $quantity
     * @param FoodId $foodId
     */
    public function __construct(DishIngredientQuantity $quantity, FoodId $foodId)
    {
        $this->quantity = $quantity;
        $this->foodId = $foodId;
    }

    /**
     * @return DishIngredientQuantity
     */
    public function getQuantity(): DishIngredientQuantity
    {
        return $this->quantity;
    }

    /**
     * @return FoodId
     */
    public function getFoodId(): FoodId
    {
        return $this->foodId;
    }
}