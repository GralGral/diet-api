<?php

namespace App\Food\Domain\Food\Repository;


use App\Food\Domain\Food\Food;

interface FoodRepositoryInterface
{
    /**
     * @param string $id
     *
     * @return Food
     */
    public function get(string $id): Food;

    /**
     * @param Food $food
     */
    public function store(Food $food): void;
}