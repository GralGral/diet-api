<?php

namespace App\Food\Domain\Dish\Event;


use App\Food\Domain\Dish\ValueObject\DishIngredient;
use App\Food\Domain\Dish\ValueObject\DishIngredientCollection;
use App\Food\Domain\Dish\ValueObject\DishLabel;
use App\Food\Domain\Dish\ValueObject\DishServingCount;
use App\Food\Domain\Shared\ValueObject\DishId;
use Broadway\Serializer\Serializable;

final class DishCreatedEvent implements Serializable
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
     * DishCreatedEvent constructor.
     *
     * @param DishId $id
     * @param DishLabel $label
     * @param DishServingCount $servingCount
     * @param DishIngredientCollection $ingredients
     */
    public function __construct(
        DishId $id,
        DishLabel $label,
        DishServingCount $servingCount,
        DishIngredientCollection $ingredients
    ) {
        $this->id = $id;
        $this->label = $label;
        $this->servingCount = $servingCount;
        $this->ingredients = $ingredients;
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
            'label' => (string) $this->label,
            'serving_count' => (string) $this->servingCount,
            'ingredients' => array_map(
                function (DishIngredient $ingredient) {
                    return [
                        'quantity' => (string) $ingredient->getQuantity(),
                        'food' => (string) $ingredient->getFoodId()
                    ];
                },
                $this->ingredients->toArray()
            )
        ];
    }

    /**
     * @return DishId
     */
    public function getId(): DishId
    {
        return $this->id;
    }

    /**
     * @return DishLabel
     */
    public function getLabel(): DishLabel
    {
        return $this->label;
    }

    /**
     * @return DishServingCount
     */
    public function getServingCount(): DishServingCount
    {
        return $this->servingCount;
    }

    /**
     * @return DishIngredientCollection
     */
    public function getIngredients(): DishIngredientCollection
    {
        return $this->ingredients;
    }
}