<?php

namespace App\Food\Application\Food\Command\Create;


class CreateFoodCommand
{
    /**
     * @var string
     */
    private $label;

    /**
     * @var string
     */
    private $brand;

    /**
     * @var string
     */
    private $barcode;

    /**
     * @var float
     */
    private $servingSize;

    /**
     * @var float
     */
    private $quantity;

    /**
     * @var bool
     */
    private $generic;

    /**
     * @var array
     */
    private $nutritionalSheet;

    public function __construct(
        string $label,
        string $brand,
        string $barcode,
        float $servingSize,
        float $quantity,
        bool $generic,
        array $nutritionalSheet
    ) {
        $this->label = $label;
        $this->brand = $brand;
        $this->barcode = $barcode;
        $this->servingSize = $servingSize;
        $this->quantity = $quantity;
        $this->generic = $generic;
        $this->nutritionalSheet = $nutritionalSheet;
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @return string
     */
    public function getBrand(): string
    {
        return $this->brand;
    }

    /**
     * @return string
     */
    public function getBarcode(): string
    {
        return $this->barcode;
    }

    /**
     * @return float
     */
    public function getServingSize(): float
    {
        return $this->servingSize;
    }

    /**
     * @return float
     */
    public function getQuantity(): float
    {
        return $this->quantity;
    }

    /**
     * @return bool
     */
    public function isGeneric(): bool
    {
        return $this->generic;
    }

    /**
     * @return array
     */
    public function getNutritionalSheet(): array
    {
        return $this->nutritionalSheet;
    }
}