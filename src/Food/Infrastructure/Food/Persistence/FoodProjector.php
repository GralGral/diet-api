<?php

namespace App\Food\Infrastructure\Food\Persistence;


use App\Food\Domain\Food\Event\FoodCreatedEvent;
use App\Food\Infrastructure\Food\Persistence\MongoDB\MongoDBFoodProjectionRepository;
use App\Food\Infrastructure\Food\Persistence\Projection\FoodProjection;
use Broadway\ReadModel\Projector;

class FoodProjector extends Projector
{
    /**
     * @var MongoDBFoodProjectionRepository
     */
    private $repository;

    /**
     * FoodProjector constructor.
     *
     * @param MongoDBFoodProjectionRepository $repository
     */
    public function __construct(MongoDBFoodProjectionRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param FoodCreatedEvent $event
     */
    protected function applyFoodCreatedEvent(FoodCreatedEvent $event): void
    {
        $food = new FoodProjection(
            $event->getId(),
            $event->getLabel(),
            $event->getBrand(),
            $event->getBarcode(),
            $event->getServingSize(),
            $event->getQuantity(),
            $event->getGeneric(),
            $event->getNutritionalSheet()
        );

        $this->repository->add($food);
    }
}
