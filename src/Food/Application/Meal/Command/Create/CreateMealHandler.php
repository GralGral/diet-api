<?php


namespace App\Food\Application\Meal\Command\Create;


use App\Food\Domain\Meal\Repository\MealRepositoryInterface;
use App\Food\Domain\Meal\Meal;
use App\Food\Domain\Meal\ValueObject\MealCategory;
use App\Food\Domain\Meal\ValueObject\MealDate;
use App\Food\Domain\Meal\ValueObject\MealDish;
use App\Food\Domain\Meal\ValueObject\MealDishCollection;
use App\Food\Domain\Meal\ValueObject\MealDishServingCount;
use App\Food\Domain\Meal\ValueObject\MealFood;
use App\Food\Domain\Meal\ValueObject\MealFoodCollection;
use App\Food\Domain\Meal\ValueObject\MealFoodQuantity;
use App\Food\Domain\Shared\ValueObject\DishId;
use App\Food\Domain\Shared\ValueObject\FoodId;
use App\Food\Domain\Shared\ValueObject\UserId;
use App\Shared\Application\Command\CommandHandlerInterface;

class CreateMealHandler implements CommandHandlerInterface
{
    /**
     * @var MealRepositoryInterface
     */
    private $repository;

    /**
     * CreateMealHandler constructor.
     *
     * @param MealRepositoryInterface $repository
     */
    public function __construct(MealRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param CreateMealCommand $command
     *
     * @return string
     */
    public function __invoke(CreateMealCommand $command): string
    {
        $foods = [];
        foreach ($command->getFoods() as $food) {
            $foods[] = new MealFood(
                new MealFoodQuantity($food['quantity']),
                new FoodId($food['food'])
            );
        }

        $dishes = [];
        foreach ($command->getDishes() as $dish) {
            $dishes[] = new MealDish(
                new MealDishServingCount($dish['serving_count']),
                new DishId($dish['dish'])
            );
        }

        $meal = Meal::create(
            new MealDate($command->getDate()),
            new MealCategory($command->getCategory()),
            new UserId($command->getUserId()),
            new MealFoodCollection($foods),
            new MealDishCollection($dishes)
        );

        $this->repository->store($meal);

        return $meal->getAggregateRootId();
    }
}