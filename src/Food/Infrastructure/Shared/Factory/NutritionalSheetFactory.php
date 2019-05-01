<?php


namespace App\Food\Infrastructure\Shared\Factory;


use App\Food\Domain\Meal\ValueObject\MealDishCollection;
use App\Food\Domain\Meal\ValueObject\MealFoodCollection;
use App\Food\Domain\Shared\ValueObject\NutritionalSheet;
use App\Food\Infrastructure\Dish\Persistence\MongoDB\MongoDBDishProjectionRepository;
use App\Food\Infrastructure\Dish\Persistence\Projection\DishProjection;
use App\Food\Infrastructure\Food\Persistence\MongoDB\MongoDBFoodProjectionRepository;
use App\Food\Infrastructure\Food\Persistence\Projection\FoodProjection;
use App\Shared\Domain\Collection;

class NutritionalSheetFactory
{
    /**
     * @var MongoDBFoodProjectionRepository
     */
    private $foodProjectionRepository;

    /**
     * @var MongoDBDishProjectionRepository
     */
    private $dishProjectionRepository;

    /**
     * NutritionalSheetFactory constructor.
     *
     * @param MongoDBFoodProjectionRepository $foodProjectionRepository
     * @param MongoDBDishProjectionRepository $dishProjectionRepository
     */
    public function __construct(
        MongoDBFoodProjectionRepository $foodProjectionRepository,
        MongoDBDishProjectionRepository $dishProjectionRepository
    ) {
        $this->dishProjectionRepository = $dishProjectionRepository;
        $this->foodProjectionRepository = $foodProjectionRepository;
    }

    /**
     * @param Collection $ingredients
     *
     * @return NutritionalSheet
     */
    public function forDish(Collection $ingredients): NutritionalSheet
    {
       return $this->fromFoods($ingredients);
    }

    /**
     * @param MealFoodCollection $foods
     * @param MealDishCollection $dishes
     *
     * @return NutritionalSheet
     */
    public function forMeal(MealFoodCollection $foods, MealDishCollection $dishes): NutritionalSheet
    {
        $nutritionalSheet = $this->fromFoods($foods);

        return $this->fromDishes($dishes, $nutritionalSheet);
    }

    /**
     * @param Collection $foods
     * @param NutritionalSheet|null $nutritionalSheet
     *
     * @return NutritionalSheet
     */
    public function fromFoods(Collection $foods, NutritionalSheet $nutritionalSheet = null)
    {
        $ids = [];
        $quantities = [];

        if (null === $nutritionalSheet) {
            $nutritionalSheet = new NutritionalSheet();
        }

        foreach ($foods as $food) {
            $ids[] = (string) $food->getFoodId();
            $quantities[(string) $food->getFoodId()] = $food->getQuantity()->getValue();
        }

        /** @var FoodProjection[] $foods */
        $foods = $this->foodProjectionRepository->findByIds($ids);

        foreach ($foods as $food) {
            $nutritionalSheet = NutritionalSheet::add(
                $nutritionalSheet,
                NutritionalSheet::forQuantity(
                    $food->getNutritionalSheet(),
                    $quantities[$food->getId()] / NutritionalSheet::BASE_QUANTITY
                )
            );
        }

        return $nutritionalSheet;
    }

    /**
     * @param Collection $dishes
     * @param NutritionalSheet|null $nutritionalSheet
     *
     * @return NutritionalSheet
     */
    public function fromDishes(Collection $dishes, NutritionalSheet $nutritionalSheet = null)
    {
        $ids = [];
        $servingCounts = [];

        if (null === $nutritionalSheet) {
            $nutritionalSheet = new NutritionalSheet();
        }

        foreach ($dishes as $dish) {
            $ids[] = (string) $dish->getDishId();
            $servingCounts[(string) $dish->getDishId()] = $dish->getServingCount()->getValue();
        }

        /** @var DishProjection[] $dishes */
        $dishes = $this->dishProjectionRepository->findByIds($ids);

        foreach ($dishes as $dish) {
            $nutritionalSheet = NutritionalSheet::add(
                $nutritionalSheet,
                NutritionalSheet::forQuantity(
                    $dish->getNutritionalSheet(),
                    $servingCounts[$dish->getId()] / $dish->getServingCount()->getValue()
                )
            );
        }

        return $nutritionalSheet;
    }
}