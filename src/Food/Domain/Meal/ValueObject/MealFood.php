<?php


namespace App\Food\Domain\Meal\ValueObject;


use App\Food\Domain\Shared\ValueObject\FoodId;

class MealFood
{
    /**
     * @var MealFoodQuantity
     */
    private $quantity;

    /**
     * @var FoodId
     */
    private $foodId;

    /**
     * MealFood constructor.
     *
     * @param MealFoodQuantity $quantity
     * @param FoodId $foodId
     */
    public function __construct(MealFoodQuantity $quantity, FoodId $foodId)
    {
        $this->quantity = $quantity;
        $this->foodId = $foodId;
    }

    /**
     * @return MealFoodQuantity
     */
    public function getQuantity(): MealFoodQuantity
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