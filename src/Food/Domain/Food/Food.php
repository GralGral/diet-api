<?php

namespace App\Food\Domain\Food;


use App\Food\Domain\Food\Event\FoodCreatedEvent;
use App\Food\Domain\Food\ValueObject\FoodBarcode;
use App\Food\Domain\Food\ValueObject\FoodBrand;
use App\Food\Domain\Food\ValueObject\FoodGeneric;
use App\Food\Domain\Food\ValueObject\FoodLabel;
use App\Food\Domain\Food\ValueObject\FoodQuantity;
use App\Food\Domain\Food\ValueObject\FoodServingSize;
use App\Food\Domain\Shared\ValueObject\FoodId;
use App\Food\Domain\Shared\ValueObject\NutritionalSheet;
use Broadway\EventSourcing\EventSourcedAggregateRoot;

class Food extends EventSourcedAggregateRoot
{
    /**
     * @var FoodId
     */
    private $id;

    /**
     * @var FoodLabel
     */
    private $label;

    /**
     * @var FoodBrand
     */
    private $brand;

    /**
     * @var FoodBarcode
     */
    private $barcode;

    /**
     * @var FoodServingSize
     */
    private $servingSize;

    /**
     * @var FoodQuantity
     */
    private $quantity;

    /**
     * @var FoodGeneric
     */
    private $generic;

    /**
     * @var NutritionalSheet
     */
    private $nutritionalSheet;

    /**
     * @param FoodLabel $label
     * @param FoodBrand $brand
     * @param FoodBarcode $barcode
     * @param FoodServingSize $servingSize
     * @param FoodQuantity $quantity
     * @param FoodGeneric $generic
     * @param NutritionalSheet $nutritionalSheet
     *
     * @return Food
     */
    public static function create(
        FoodLabel $label,
        FoodBrand $brand,
        FoodBarcode $barcode,
        FoodServingSize $servingSize,
        FoodQuantity $quantity,
        FoodGeneric $generic,
        NutritionalSheet $nutritionalSheet
    ): Food {
        $food = new self();

        $food->apply(
            new FoodCreatedEvent(
                new FoodId(),
                $label,
                $brand,
                $barcode,
                $servingSize,
                $quantity,
                $generic,
                $nutritionalSheet
            )
        );

        return $food;
    }

    /**
     * @return string
     */
    public function getAggregateRootId(): string
    {
        return (string) $this->id;
    }

    /**
     * @param FoodCreatedEvent $event
     */
    public function applyFoodCreatedEvent(FoodCreatedEvent $event): void
    {
        $this->id = $event->getId();
        $this->label = $event->getLabel();
        $this->brand = $event->getBrand();
        $this->barcode = $event->getBarcode();
        $this->servingSize = $event->getServingSize();
        $this->quantity = $event->getQuantity();
        $this->generic = $event->getGeneric();
        $this->nutritionalSheet = $event->getNutritionalSheet();
    }
}