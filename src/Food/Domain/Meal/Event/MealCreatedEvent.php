<?php


namespace App\Food\Domain\Meal\Event;


use App\Food\Domain\Meal\ValueObject\MealCategory;
use App\Food\Domain\Meal\ValueObject\MealDate;
use App\Food\Domain\Meal\ValueObject\MealDish;
use App\Food\Domain\Meal\ValueObject\MealDishCollection;
use App\Food\Domain\Meal\ValueObject\MealFood;
use App\Food\Domain\Meal\ValueObject\MealFoodCollection;
use App\Food\Domain\Meal\ValueObject\MealId;
use App\Food\Domain\Shared\ValueObject\UserId;
use Broadway\Serializer\Serializable;

final class MealCreatedEvent implements Serializable
{
    /**
     * @var MealId
     */
    private $id;

    /**
     * @var MealDate
     */
    private $date;

    /**
     * @var MealCategory
     */
    private $category;

    /**
     * @var
     */
    private $userId;

    /**
     * @var MealFoodCollection
     */
    private $mealFoods;

    /**
     * @var MealDishCollection
     */
    private $mealDishes;

    /**
     * MealCreatedEvent constructor.
     *
     * @param MealId $id
     * @param MealDate $date
     * @param MealCategory $category
     * @param UserId $userId
     * @param MealFoodCollection $mealFoods
     * @param MealDishCollection $mealDishes
     */
    public function __construct(
        MealId $id,
        MealDate $date,
        MealCategory $category,
        UserId $userId,
        MealFoodCollection $mealFoods,
        MealDishCollection $mealDishes
    ) {
        $this->id = $id;
        $this->date = $date;
        $this->category = $category;
        $this->userId = $userId;
        $this->mealFoods = $mealFoods;
        $this->mealDishes = $mealDishes;
    }

    /**
     * @return mixed The object instance
     */
    public static function deserialize(array $data)
    {
        // TODO: Implement deserialize() method.
    }

    /**
     * @return array
     */
    public function serialize(): array
    {
        return [
            'id' => (string) $this->id,
            'date' => (string) $this->date,
            'category' => (string) $this->category,
            'user' => (string) $this->category,
            'foods' => array_map(
                function (MealFood $mealFood) {
                    return [
                        'quantity' => (string) $mealFood->getQuantity(),
                        'food' => (string) $mealFood->getFoodId()
                    ];
                },
                $this->mealFoods->toArray()
            ),
            'dishes' => array_map(
                function (MealDish $mealDish) {
                    return [
                        'serving_count' => (string) $mealDish->getServingCount(),
                        'dish' => (string) $mealDish->getDishId()
                    ];
                },
                $this->mealDishes->toArray()
            )
        ];
    }

    /**
     * @return MealId
     */
    public function getId(): MealId
    {
        return $this->id;
    }

    /**
     * @return MealDate
     */
    public function getDate(): MealDate
    {
        return $this->date;
    }

    /**
     * @return MealCategory
     */
    public function getCategory(): MealCategory
    {
        return $this->category;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @return MealFoodCollection
     */
    public function getMealFoods(): MealFoodCollection
    {
        return $this->mealFoods;
    }

    /**
     * @return MealDishCollection
     */
    public function getMealDishes(): MealDishCollection
    {
        return $this->mealDishes;
    }
}