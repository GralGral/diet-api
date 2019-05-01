<?php


namespace App\Food\Application\Dish\Command\Create;


class CreateDishCommand
{
    /**
     * @var string
     */
    private $label;

    /**
     * @var float
     */
    private $servingCount;

    /**
     * @var array
     */
    private $ingredients;

    public function __construct(string $label, float $servingCount, array $ingredients)
    {
        $this->label = $label;
        $this->servingCount = $servingCount;
        $this->ingredients = $ingredients;
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @return float
     */
    public function getServingCount(): float
    {
        return $this->servingCount;
    }

    /**
     * @return array
     */
    public function getIngredients(): array
    {
        return $this->ingredients;
    }
}