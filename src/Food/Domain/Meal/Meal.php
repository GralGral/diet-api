<?php


namespace App\Food\Domain\Meal;


use App\Food\Domain\Meal\Event\MealCreatedEvent;
use App\Food\Domain\Meal\ValueObject\MealCategory;
use App\Food\Domain\Meal\ValueObject\MealDate;
use App\Food\Domain\Meal\ValueObject\MealDishCollection;
use App\Food\Domain\Meal\ValueObject\MealFoodCollection;
use App\Food\Domain\Meal\ValueObject\MealId;
use App\Food\Domain\Shared\ValueObject\UserId;
use Broadway\EventSourcing\EventSourcedAggregateRoot;

final class Meal extends EventSourcedAggregateRoot
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
    private $mealFoods;

    /**
     * @var MealDishCollection
     */
    private $mealDishes;

    /**
     * @param MealDate $date
     * @param MealCategory $category
     * @param UserId $userId
     * @param MealFoodCollection $foods
     * @param MealDishCollection $dishes
     *
     * @return Meal
     */
    public static function create(
        MealDate $date,
        MealCategory $category,
        UserId $userId,
        MealFoodCollection $foods,
        MealDishCollection $dishes
    ): Meal {
        $meal = new self();

        $meal->apply(new MealCreatedEvent(
            new MealId(),
            $date,
            $category,
            $userId,
            $foods,
            $dishes
        ));

        return $meal;
    }

    /**
     * @return string
     */
    public function getAggregateRootId(): string
    {
        return (string) $this->id;
    }

    /**
     * @param MealCreatedEvent $event
     */
    public function applyMealCreatedEvent(MealCreatedEvent $event): void
    {
        $this->id = $event->getId();
        $this->date = $event->getDate();
        $this->category = $event->getCategory();
        $this->userId = $event->getUserId();
        $this->mealFoods = $event->getMealFoods();
        $this->mealDishes = $event->getMealDishes();
    }
}