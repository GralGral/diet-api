<?php

namespace App\User\UI\Http\Controller\User;


use App\User\Application\User\Query\Find\FindUserQuery;
use App\User\Infrastructure\User\Persistence\Projection\UserProjection;
use App\Shared\UI\Http\Controller\QueryController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/users/{id}", name="users_get_one")
 */
final class GetUserController extends QueryController
{
    /**
     * @param string $id
     *
     * @return JsonResponse
     */
    public function __invoke(string $id): JsonResponse
    {
        $query = new FindUserQuery($id);

        /** @var UserProjection $user */
        $user = $this->query($query);

        if (null === $user) {
            return new JsonResponse(null, Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse(
            $user->serialize(),
            Response::HTTP_OK
        );
    }
}