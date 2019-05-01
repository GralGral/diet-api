<?php

namespace App\Food\Domain\Shared\ValueObject;


class NutritionalSheet
{
    public const BASE_QUANTITY = 100.00;

    /**
     * @var NutritionalSheetValue
     */
    private $proteins;

    /**
     * @var NutritionalSheetValue
     */
    private $fats;

    /**
     * @var NutritionalSheetValue
     */
    private $carbs;

    /**
     * @var NutritionalSheetValue
     */
    private $calories;

    /**
     * NutritionalSheet constructor.
     *
     * @param array $nutritionalSheet
     */
    public function __construct(array $nutritionalSheet = [])
    {
        $this->proteins = new NutritionalSheetValue($nutritionalSheet['proteins'] ?? 0);
        $this->fats = new NutritionalSheetValue($nutritionalSheet['fats'] ?? 0);
        $this->carbs = new NutritionalSheetValue($nutritionalSheet['carbs'] ?? 0);
        $this->calories = new NutritionalSheetValue($nutritionalSheet['calories'] ?? 0);
    }

    /**
     * @param NutritionalSheet $sheet
     * @param NutritionalSheet $_sheet
     *
     * @return NutritionalSheet
     */
    public static function add(NutritionalSheet $sheet, NutritionalSheet $_sheet): NutritionalSheet
    {
        return new self([
            'proteins' => $sheet->getProteins()->getValue() + $_sheet->getProteins()->getValue(),
            'fats' => $sheet->getFats()->getValue() + $_sheet->getFats()->getValue(),
            'carbs' => $sheet->getCarbs()->getValue() + $_sheet->getCarbs()->getValue(),
            'calories' => $sheet->getCalories()->getValue() + $_sheet->getCalories()->getValue(),
        ]);
    }

    /**
     * @param NutritionalSheet $sheet
     * @param float $quantity
     *
     * @return NutritionalSheet
     */
    public static function forQuantity(NutritionalSheet $sheet, float $quantity): NutritionalSheet
    {
        return new self([
            'proteins' => $sheet->getProteins()->getValue() * $quantity,
            'fats' => $sheet->getFats()->getValue() * $quantity,
            'carbs' => $sheet->getCarbs()->getValue() * $quantity,
            'calories' => $sheet->getCalories()->getValue() * $quantity,
        ]);
    }

    /**
     * @return NutritionalSheetValue
     */
    public function getProteins(): NutritionalSheetValue
    {
        return $this->proteins;
    }

    /**
     * @return NutritionalSheetValue
     */
    public function getFats(): NutritionalSheetValue
    {
        return $this->fats;
    }

    /**
     * @return NutritionalSheetValue
     */
    public function getCarbs(): NutritionalSheetValue
    {
        return $this->carbs;
    }

    /**
     * @return NutritionalSheetValue
     */
    public function getCalories(): NutritionalSheetValue
    {
        return $this->calories;
    }
}