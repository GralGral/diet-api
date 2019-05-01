<?php


namespace App\Food\Infrastructure\Dish\Persistence;


use App\Food\Domain\Dish\Event\DishCreatedEvent;
use App\Food\Infrastructure\Dish\Persistence\MongoDB\MongoDBDishProjectionRepository;
use App\Food\Infrastructure\Dish\Persistence\Projection\DishProjection;
use App\Food\Infrastructure\Shared\Factory\NutritionalSheetFactory;
use Broadway\ReadModel\Projector;

class DishProjector extends Projector
{
    /**
     * @var MongoDBDishProjectionRepository
     */
    private $repository;

    /**
     * @var NutritionalSheetFactory
     */
    private $nutritionalSheetFactory;

    /**
     * DishProjector constructor.
     *
     * @param MongoDBDishProjectionRepository $repository
     * @param NutritionalSheetFactory $nutritionalSheetFactory
     */
    public function __construct(
        MongoDBDishProjectionRepository $repository,
        NutritionalSheetFactory $nutritionalSheetFactory
    ) {
        $this->repository = $repository;
        $this->nutritionalSheetFactory = $nutritionalSheetFactory;
    }

    /**
     * @param DishCreatedEvent $event
     */
    protected function applyDishCreatedEvent(DishCreatedEvent $event): void
    {
        $dish = new DishProjection(
            $event->getId(),
            $event->getLabel(),
            $event->getServingCount(),
            $event->getIngredients(),
            $this->nutritionalSheetFactory->forDish($event->getIngredients())
        );

        $this->repository->add($dish);
    }
}