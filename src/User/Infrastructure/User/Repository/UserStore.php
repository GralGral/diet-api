<?php

declare(strict_types=1);

namespace App\User\Infrastructure\User\Repository;


use App\Shared\Infrastructure\EventSourcing\EventSourcingRepository;
use App\User\Domain\User\Repository\UserRepositoryInterface;
use App\User\Domain\User\User;

final class UserStore extends EventSourcingRepository implements UserRepositoryInterface
{
    /**
     * @inheritdoc
     */
    public function get(string $id): User
    {
        /** @var User $user */
        $user = $this->load($id);

        return $user;
    }

    /**
     * @inheritdoc
     */
    public function store(User $user): void
    {
        $this->save($user);
    }

    /**
     * @inheritdoc
     */
    protected function getAggregateClass(): string
    {
        return User::class;
    }
}