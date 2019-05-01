<?php


namespace App\Food\UI\Http\Controller\Meal;


use App\Food\Application\Meal\Command\Create\CreateMealCommand;
use App\Shared\UI\Http\Controller\CommandController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(path="/meals", methods={"POST"}, name="meal_create")
 */
final class PostMealController extends CommandController
{
    public function __invoke(Request $request)
    {
        $content = json_decode($request->getContent(), true);

        $command = new CreateMealCommand(
            $content['date'],
            $content['category'],
            $content['user'],
            $content['foods'],
            $content['dishes']
        );

        $id = $this->exec($command);

        return new JsonResponse(['id' => $id], Response::HTTP_CREATED);
    }
}