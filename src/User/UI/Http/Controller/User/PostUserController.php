<?php

namespace App\User\UI\Http\Controller\User;


use App\User\Application\User\Command\Create\CreateUserCommand;
use App\Shared\UI\Http\Controller\CommandController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/users", methods={"POST"}, name="user_create")
 */
final class PostUserController extends CommandController
{
    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function __invoke(Request $request)
    {
        $content = json_decode($request->getContent(), true);
        // TODO Should be replaced by a DTO

        $command = new CreateUserCommand(
            $content['firstname'],
            $content['lastname'],
            $content['email'],
            $content['password']
        );

        $id = $this->exec($command);

        return new JsonResponse(['id' => $id], Response::HTTP_CREATED);
    }
}