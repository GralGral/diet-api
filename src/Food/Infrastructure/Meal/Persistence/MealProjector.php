<?php


namespace App\Food\Infrastructure\Meal\Persistence;


use App\Food\Domain\Meal\Event\MealCreatedEvent;
use App\Food\Infrastructure\Meal\Persistence\MongoDB\MongoDBMealProjectionRepository;
use App\Food\Infrastructure\Meal\Persistence\Projection\MealProjection;
use App\Food\Infrastructure\Shared\Factory\NutritionalSheetFactory;
use Broadway\ReadModel\Projector;

class MealProjector extends Projector
{
    /**
     * @var MongoDBMealProjectionRepository
     */
    private $repository;

    /**
     * @var NutritionalSheetFactory
     */
    private $nutritionalSheetFactory;

    public function __construct(
        MongoDBMealProjectionRepository $repository,
        NutritionalSheetFactory $nutritionalSheetFactory
    ) {
        $this->repository = $repository;
        $this->nutritionalSheetFactory = $nutritionalSheetFactory;
    }

    /**
     * @param MealCreatedEvent $event
     */
    public function applyMealCreatedEvent(MealCreatedEvent $event): void
    {
        $meal = new MealProjection(
            $event->getId(),
            $event->getDate(),
            $event->getCategory(),
            $event->getUserId(),
            $event->getMealFoods(),
            $event->getMealDishes(),
            $this->nutritionalSheetFactory->forMeal(
                $event->getMealFoods(),
                $event->getMealDishes()
            )
        );

        $this->repository->add($meal);
    }
}