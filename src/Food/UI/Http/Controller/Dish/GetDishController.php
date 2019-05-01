<?php


namespace App\Food\UI\Http\Controller\Dish;


use App\Food\Application\Dish\Query\Find\FindDishQuery;
use App\Food\Infrastructure\Dish\Persistence\Projection\DishProjection;
use App\Shared\UI\Http\Controller\QueryController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(path="/dishes/{id}", methods={"GET"}, name="dish_get_one")
 */
final class GetDishController extends QueryController
{
    public function __invoke(string $id)
    {
        $query = new FindDishQuery($id);

        /** @var DishProjection $dish */
        $dish = $this->query($query);

        if (null === $dish) {
            return new JsonResponse(null, Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse(
            $dish->serialize(),
            Response::HTTP_OK);
    }
}