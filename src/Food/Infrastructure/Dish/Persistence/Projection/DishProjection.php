<?php


namespace App\Food\Infrastructure\Dish\Persistence\Projection;


use App\Food\Domain\Dish\ValueObject\DishIngredient;
use App\Food\Domain\Dish\ValueObject\DishIngredientCollection;
use App\Food\Domain\Dish\ValueObject\DishLabel;
use App\Food\Domain\Dish\ValueObject\DishServingCount;
use App\Food\Domain\Shared\ValueObject\DishId;
use App\Food\Domain\Shared\ValueObject\NutritionalSheet;
use App\Shared\Infrastructure\Persistence\Projection\Projection;

class DishProjection extends Projection
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
     * @var NutritionalSheet
     */
    private $nutritionalSheet;

    /**
     * DishProjection constructor.
     *
     * @param DishId $id
     * @param DishLabel $label
     * @param DishServingCount $servingCount
     * @param DishIngredientCollection $ingredients
     * @param NutritionalSheet $nutritionalSheet
     */
    public function __construct(
        DishId $id,
        DishLabel $label,
        DishServingCount $servingCount,
        DishIngredientCollection $ingredients,
        NutritionalSheet $nutritionalSheet
    ) {
        $this->id = $id;
        $this->label = $label;
        $this->servingCount = $servingCount;
        $this->ingredients = $ingredients;
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