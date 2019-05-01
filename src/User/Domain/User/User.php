<?php

declare(strict_types=1);

namespace App\User\Domain\User;


use App\User\Domain\User\Event\UserCreatedEvent;
use App\User\Domain\User\ValueObject\Auth\UserCredentials;
use App\User\Domain\User\ValueObject\UserFirstname;
use App\User\Domain\User\ValueObject\UserLastname;
use App\User\Domain\User\ValueObject\UserId;
use Broadway\EventSourcing\EventSourcedAggregateRoot;

class User extends EventSourcedAggregateRoot
{
    /**
     * @var UserId
     */
    private $id;

    /**
     * @var UserFirstname
     */
    private $firstname;

    /**
     * @var UserLastname
     */
    private $lastname;

    /**
     * @var UserCredentials
     */
    private $credentials;

    /**
     * @param UserFirstname $firstname
     * @param UserLastname $lastname
     * @param UserCredentials $credentials
     *
     * @return User
     */
    public static function create(
        UserFirstname $firstname,
        UserLastname $lastname,
        UserCredentials $credentials
    ): User {
        $user = new self();

        $user->apply(
            new UserCreatedEvent(
                new UserId(),
                $firstname,
                $lastname,
                $credentials
            )
        );

        return $user;
    }

    /**
     * @return string
     */
    public function getAggregateRootId(): string
    {
        return (string) $this->id;
    }

    /**
     * @param UserCreatedEvent $event
     */
    public function applyUserCreatedEvent(UserCreatedEvent $event): void
    {
        $this->id = $event->getId();
        $this->firstname = $event->getFirstname();
        $this->lastname = $event->getLastname();
        $this->credentials = $event->getCredentials();
    }
}