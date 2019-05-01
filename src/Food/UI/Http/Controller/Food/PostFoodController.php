<?php

namespace App\Food\UI\Http\Controller\Food;


use App\Food\Application\Food\Command\Create\CreateFoodCommand;
use App\Shared\UI\Http\Controller\CommandController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(path="/foods", methods={"POST"}, name="food_create")
 */
final class PostFoodController extends CommandController
{
    public function __invoke(Request $request)
    {
        $content = json_decode($request->getContent(), true);

        $command = new CreateFoodCommand(
            $content['label'],
            $content['brand'],
            $content['barcode'],
            $content['serving_size'],
            $content['quantity'],
            $content['generic'],
            $content['nutritional_sheet']
        );

        $id = $this->exec($command);

        return new JsonResponse(['id' => $id], Response::HTTP_CREATED);
    }
}