<?php


namespace App\Food\Domain\Meal\ValueObject;


use App\Food\Domain\Shared\ValueObject\DishId;

class MealDish
{
    /**
     * @var MealDishServingCount
     */
    private $servingCount;

    /**
     * @var DishId
     */
    private $dishId;

    /**
     * MealDish constructor.
     *
     * @param MealDishServingCount $servingCount
     * @param DishId $dishId
     */
    public function __construct(MealDishServingCount $servingCount, DishId $dishId)
    {
        $this->servingCount = $servingCount;
        $this->dishId = $dishId;
    }

    /**
     * @return MealDishServingCount
     */
    public function getServingCount(): MealDishServingCount
    {
        return $this->servingCount;
    }

    /**
     * @return DishId
     */
    public function getDishId(): DishId
    {
        return $this->dishId;
    }
}