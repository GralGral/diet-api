<?php

namespace App\User\Application\User\Command\Create;


use App\User\Domain\User\Repository\UserRepositoryInterface;
use App\User\Domain\User\User;
use App\Shared\Application\Command\CommandHandlerInterface;
use App\User\Domain\User\ValueObject\Auth\UserCredentials;
use App\User\Domain\User\ValueObject\Auth\UserPassword;
use App\User\Domain\User\ValueObject\UserEmail;
use App\User\Domain\User\ValueObject\UserFirstname;
use App\User\Domain\User\ValueObject\UserLastname;

class CreateUserHandler implements CommandHandlerInterface
{
    /**
     * @var UserRepositoryInterface
     */
    private $repository;

    /**
     * CreateUserHandler constructor.
     *
     * @param UserRepositoryInterface $repository
     */
    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param CreateUserCommand $command
     *
     * @return string
     */
    public function __invoke(CreateUserCommand $command): string
    {
        $user = User::create(
            new UserFirstname($command->getFirstname()),
            new UserLastname($command->getLastname()),
            new UserCredentials(
                new UserEmail($command->getEmail()),
                new UserPassword($command->getPlainPassword())
            )
        );

        $this->repository->store($user);

        return $user->getAggregateRootId();
    }
}