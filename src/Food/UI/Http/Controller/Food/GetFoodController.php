<?php

namespace App\Food\UI\Http\Controller\Food;


use App\Food\Application\Food\Query\Find\FindFoodQuery;
use App\Food\Infrastructure\Food\Persistence\Projection\FoodProjection;
use App\Shared\UI\Http\Controller\QueryController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(path="/foods/{id}", methods={"GET"}, name="foods_get_one")
 */
final class GetFoodController extends QueryController
{
    public function __invoke(string $id)
    {
        $query = new FindFoodQuery($id);

        /** @var FoodProjection $food */
        $food = $this->query($query);

        if (null === $food) {
            return new JsonResponse(null, Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse(
            $food->serialize(),
            Response::HTTP_OK);
    }
}