<?php

declare(strict_types=1);

namespace App\User\Domain\User\Repository;


use App\User\Domain\User\User;

interface UserRepositoryInterface
{
    /**
     * @param string $id
     *
     * @return User
     */
    public function get(string $id): User;

    /**
     * @param User $user
     */
    public function store(User $user): void;
}