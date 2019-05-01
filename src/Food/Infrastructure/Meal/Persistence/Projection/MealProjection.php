<?php


namespace App\Food\Infrastructure\Meal\Persistence\Projection;


use App\Food\Domain\Meal\ValueObject\MealCategory;
use App\Food\Domain\Meal\ValueObject\MealDate;
use App\Food\Domain\Meal\ValueObject\MealDish;
use App\Food\Domain\Meal\ValueObject\MealDishCollection;
use App\Food\Domain\Meal\ValueObject\MealFood;
use App\Food\Domain\Meal\ValueObject\MealFoodCollection;
use App\Food\Domain\Meal\ValueObject\MealId;
use App\Food\Domain\Shared\ValueObject\NutritionalSheet;
use App\Food\Domain\Shared\ValueObject\UserId;
use App\Shared\Infrastructure\Persistence\Projection\Projection;

class MealProjection extends Projection
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
     * @var UserId
     */
    private $userId;

    /**
     * @var MealFoodCollection
     */
    private $foods;

    /**
     * @var MealDishCollection
     */
    private $dishes;

    /**
     * @var NutritionalSheet
     */
    private $nutritionalSheet;

    /**
     * MealProjection constructor.
     *
     * @param MealId $id
     * @param MealDate $date
     * @param MealCategory $category
     * @param UserId $userId
     * @param MealFoodCollection $foods
     * @param MealDishCollection $dishes
     * @param NutritionalSheet $nutritionalSheet
     */
    public function __construct(
        MealId $id,
        MealDate $date,
        MealCategory $category,
        UserId $userId,
        MealFoodCollection $foods,
        MealDishCollection $dishes,
        NutritionalSheet $nutritionalSheet
    ) {
        $this->id = $id;
        $this->date = $date;
        $this->category = $category;
        $this->userId = $userId;
        $this->foods = $foods;
        $this->dishes = $dishes;
        $this->nutritionalSheet = $nutritionalSheet;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return (string) $this->id;
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
     * @return UserId
     */
    public function getUserId(): UserId
    {
        return $this->userId;
    }

    /**
     * @return MealFoodCollection
     */
    public function getFoods(): MealFoodCollection
    {
        return $this->foods;
    }

    /**
     * @return MealDishCollection
     */
    public function getDishes(): MealDishCollection
    {
        return $this->dishes;
    }

    /**
     * @return NutritionalSheet
     */
    public function getNutritionalSheet(): NutritionalSheet
    {
        return $this->nutritionalSheet;
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
            'user' => (string) $this->userId,
            'foods' => array_map(
                function (MealFood $mealFood) {
                    return [
                        'quantity' => (string) $mealFood->getQuantity(),
                        'food' => (string) $mealFood->getFoodId()
                    ];
                },
                $this->foods->toArray()
            ),
            'dishes' => array_map(
                function (MealDish $mealDish) {
                    return [
                        'serving_count' => (string) $mealDish->getServingCount(),
                        'dish' => (string) $mealDish->getDishId()
                    ];
                },
                $this->dishes->toArray()
            ),
            'nutritional_sheet' => [
                'proteins' => (string) $this->nutritionalSheet->getProteins(),
                'fats' => (string) $this->nutritionalSheet->getFats(),
                'carbs' => (string) $this->nutritionalSheet->getCarbs(),
                'calories' => (string) $this->nutritionalSheet->getCalories(),
            ],
        ];
    }
}