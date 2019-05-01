<?php


namespace App\Food\Application\Dish\Query\Find;


use App\Food\Domain\Shared\ValueObject\DishId;

class FindDishQuery
{
    /**
     * @var DishId
     */
    private $id;

    /**
     * DishFoodQuery constructor.
     *
     * @param string $id
     */
    public function __construct(string $id)
    {
        $this->id = new DishId($id);
    }

    /**
     * @return DishId
     */
    public function getId(): DishId
    {
        return $this->id;
    }
}