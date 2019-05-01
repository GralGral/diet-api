<?php


namespace App\Food\UI\Http\Controller\Meal;


use App\Food\Application\Meal\Command\Find\FindMealQuery;
use App\Food\Infrastructure\Meal\Persistence\Projection\MealProjection;
use App\Shared\UI\Http\Controller\QueryController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(path="/meals/{id}", methods={"GET"}, name="meal_get_one")
 */
final class GetMealController extends QueryController
{
    public function __invoke(string $id)
    {
        $query = new FindMealQuery($id);

        /** @var MealProjection $meal */
        $meal = $this->query($query);

        if (null === $meal) {
            return new JsonResponse(null, Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse(
            $meal->serialize(),
            Response::HTTP_OK);
    }
}