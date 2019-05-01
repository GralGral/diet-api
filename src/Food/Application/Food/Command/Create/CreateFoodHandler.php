<?php

namespace App\Food\Application\Food\Command\Create;


use App\Food\Domain\Food\Food;
use App\Food\Domain\Food\Repository\FoodRepositoryInterface;
use App\Food\Domain\Food\ValueObject\FoodBarcode;
use App\Food\Domain\Food\ValueObject\FoodBrand;
use App\Food\Domain\Food\ValueObject\FoodGeneric;
use App\Food\Domain\Food\ValueObject\FoodLabel;
use App\Food\Domain\Food\ValueObject\FoodQuantity;
use App\Food\Domain\Food\ValueObject\FoodServingSize;
use App\Food\Domain\Shared\ValueObject\NutritionalSheet;
use App\Shared\Application\Command\CommandHandlerInterface;

class CreateFoodHandler implements CommandHandlerInterface
{
    /**
     * @var FoodRepositoryInterface
     */
    private $repository;

    public function __construct(FoodRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param CreateFoodCommand $command
     *
     * @return string
     */
    public function __invoke(CreateFoodCommand $command): string
    {
        $food = Food::create(
            new FoodLabel($command->getLabel()),
            new FoodBrand($command->getBrand()),
            new FoodBarcode($command->getBarcode()),
            new FoodServingSize($command->getServingSize()),
            new FoodQuantity($command->getQuantity()),
            new FoodGeneric($command->isGeneric()),
            new NutritionalSheet($command->getNutritionalSheet())
        );

        $this->repository->store($food);

        return $food->getAggregateRootId();
    }
}