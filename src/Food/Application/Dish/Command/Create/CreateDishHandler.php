<?php


namespace App\Food\Application\Dish\Command\Create;


use App\Food\Domain\Dish\Dish;
use App\Food\Domain\Dish\ValueObject\DishIngredient;
use App\Food\Domain\Dish\ValueObject\DishIngredientCollection;
use App\Food\Domain\Dish\ValueObject\DishIngredientQuantity;
use App\Food\Domain\Dish\ValueObject\DishLabel;
use App\Food\Domain\Dish\ValueObject\DishServingCount;
use App\Food\Domain\Shared\ValueObject\FoodId;
use App\Food\Infrastructure\Dish\Repository\DishStore;
use App\Shared\Application\Command\CommandHandlerInterface;

class CreateDishHandler implements CommandHandlerInterface
{
    /**
     * @var DishStore
     */
    private $repository;

    public function __construct(DishStore $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param CreateDishCommand $command
     *
     * @return string
     */
    public function __invoke(CreateDishCommand $command)
    {
        $ingredients = [];
        foreach ($command->getIngredients() as $ingredient) {
            $ingredients[] = new DishIngredient(
                new DishIngredientQuantity($ingredient['quantity']),
                new FoodId($ingredient['food'])
            );
        }

        $dish = Dish::create(
            new DishLabel($command->getLabel()),
            new DishServingCount($command->getServingCount()),
            new DishIngredientCollection($ingredients)
        );

        $this->repository->store($dish);

        return $dish->getAggregateRootId();
    }
}