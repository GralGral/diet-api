<?php

namespace App\Food\Application\Food\Query\Find;


use App\Food\Domain\Shared\ValueObject\FoodId;

class FindFoodQuery
{
    /**
     * @var FoodId
     */
    private $id;

    /**
     * FindFoodQuery constructor.
     *
     * @param string $id
     */
    public function __construct(string $id)
    {
        $this->id = new FoodId($id);
    }

    /**
     * @return FoodId
     */
    public function getId(): FoodId
    {
        return $this->id;
    }
}