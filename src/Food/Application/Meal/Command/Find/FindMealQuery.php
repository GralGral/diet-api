<?php


namespace App\Food\Application\Meal\Command\Find;


use App\Food\Domain\Meal\ValueObject\MealId;

class FindMealQuery
{
    /**
     * @var MealId
     */
    private $id;

    /**
     * FindMealQuery constructor.
     *
     * @param string $id
     */
    public function __construct(string $id)
    {
        $this->id = new MealId($id);
    }

    /**
     * @return MealId
     */
    public function getId(): MealId
    {
        return $this->id;
    }
}