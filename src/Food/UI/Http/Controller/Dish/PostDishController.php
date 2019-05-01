<?php


namespace App\Food\UI\Http\Controller\Dish;


use App\Food\Application\Dish\Command\Create\CreateDishCommand;
use App\Shared\UI\Http\Controller\CommandController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(path="/dishes", methods={"POST"}, name="dish_create")
 */
final class PostDishController extends CommandController
{
    public function __invoke(Request $request)
    {
        $content = json_decode($request->getContent(), true);

        $command = new CreateDishCommand(
            $content['label'],
            $content['serving_count'],
            $content['ingredients']
        );

        $id = $this->exec($command);

        return new JsonResponse(['id' => $id], Response::HTTP_OK);
    }
}