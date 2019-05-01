<?php

namespace App\Food\Domain\Dish;


use App\Food\Domain\Dish\Event\DishCreatedEvent;
use App\Food\Domain\Dish\ValueObject\DishIngredientCollection;
use App\Food\Domain\Dish\ValueObject\DishLabel;
use App\Food\Domain\Dish\ValueObject\DishServingCount;
use App\Food\Domain\Shared\ValueObject\DishId;
use Broadway\EventSourcing\EventSourcedAggregateRoot;

class Dish extends EventSourcedAggregateRoot
{
    /**
     * @var DishId
     */
    private $id;

    /**
     * @var DishLabel
     */
    private $label;

    /**
     * @var DishServingCount
     */
    private $servingCount;

    /**
     * @var DishIngredientCollection
     */
    private $ingredients;

    /**
     * @param DishLabel $label
     * @param DishServingCount $servingCount
     * @param DishIngredientCollection $ingredients
     *
     * @return Dish
     */
    public static function create(
        DishLabel $label,
        DishServingCount $servingCount,
        DishIngredientCollection $ingredients
    ): Dish {
        $dish = new self();

        $dish->apply(
            new DishCreatedEvent(
                new DishId(),
                $label,
                $servingCount,
                $ingredients
            )
        );

        return $dish;
    }

    /**
     * @return string
     */
    public function getAggregateRootId(): string
    {
        return (string) $this->id;
    }

    /**
     * @param DishCreatedEvent $event
     */
    public function applyDishCreatedEvent(DishCreatedEvent $event)
    {
        $this->id = $event->getId();
        $this->label = $event->getLabel();
        $this->servingCount = $event->getServingCount();
        $this->ingredients = $event->getIngredients();
    }
}