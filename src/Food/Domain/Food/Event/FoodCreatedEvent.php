<?php

namespace App\Food\Domain\Food\Event;


use App\Food\Domain\Food\ValueObject\FoodBarcode;
use App\Food\Domain\Food\ValueObject\FoodBrand;
use App\Food\Domain\Food\ValueObject\FoodGeneric;
use App\Food\Domain\Food\ValueObject\FoodLabel;
use App\Food\Domain\Food\ValueObject\FoodQuantity;
use App\Food\Domain\Food\ValueObject\FoodServingSize;
use App\Food\Domain\SHared\ValueObject\FoodId;
use App\Food\Domain\Shared\ValueObject\NutritionalSheet;
use Broadway\Serializer\Serializable;

class FoodCreatedEvent implements Serializable
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
     * FoodCreatedEvent constructor.
     *
     * @param FoodId $id
     * @param FoodLabel $label
     * @param FoodBrand $brand
     * @param FoodBarcode $barcode
     * @param FoodServingSize $servingSize
     * @param FoodQuantity $quantity
     * @param FoodGeneric $generic
     * @param NutritionalSheet $nutritionalSheet
     */
    public function __construct(
        FoodId $id,
        FoodLabel $label,
        FoodBrand $brand,
        FoodBarcode $barcode,
        FoodServingSize $servingSize,
        FoodQuantity $quantity,
        FoodGeneric $generic,
        NutritionalSheet $nutritionalSheet
    ) {
        $this->id = $id;
        $this->label = $label;
        $this->brand = $brand;
        $this->barcode = $barcode;
        $this->servingSize = $servingSize;
        $this->quantity = $quantity;
        $this->generic = $generic;
        $this->nutritionalSheet = $nutritionalSheet;
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
            'brand' => (string) $this->brand,
            'barcode' => (string) $this->barcode,
            'serving_size' => (string) $this->servingSize,
            'quantity' => (string) $this->quantity,
            'generic' => (string) $this->generic,
            'nutritional_sheet' => [
                'proteins' => (string) $this->nutritionalSheet->getProteins(),
                'fats' => (string) $this->nutritionalSheet->getFats(),
                'carbs' => (string) $this->nutritionalSheet->getCarbs(),
                'calories' => (string) $this->nutritionalSheet->getCalories(),
            ],
        ];
    }

    /**
     * @return FoodId
     */
    public function getId(): FoodId
    {
        return $this->id;
    }

    /**
     * @return FoodLabel
     */
    public function getLabel(): FoodLabel
    {
        return $this->label;
    }

    /**
     * @return FoodBrand
     */
    public function getBrand(): FoodBrand
    {
        return $this->brand;
    }

    /**
     * @return FoodBarcode
     */
    public function getBarcode(): FoodBarcode
    {
        return $this->barcode;
    }

    /**
     * @return FoodServingSize
     */
    public function getServingSize(): FoodServingSize
    {
        return $this->servingSize;
    }

    /**
     * @return FoodQuantity
     */
    public function getQuantity(): FoodQuantity
    {
        return $this->quantity;
    }

    /**
     * @return FoodGeneric
     */
    public function getGeneric(): FoodGeneric
    {
        return $this->generic;
    }

    /**
     * @return NutritionalSheet
     */
    public function getNutritionalSheet(): NutritionalSheet
    {
        return $this->nutritionalSheet;
    }
}