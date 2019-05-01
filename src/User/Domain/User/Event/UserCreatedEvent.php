<?php

declare(strict_types=1);

namespace App\User\Domain\User\Event;


use App\User\Domain\User\ValueObject\Auth\UserCredentials;
use App\User\Domain\User\ValueObject\UserFirstname;
use App\User\Domain\User\ValueObject\UserLastname;
use App\User\Domain\User\ValueObject\UserId;
use Broadway\Serializer\Serializable;

final class UserCreatedEvent implements Serializable
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
     * UserCreatedEvent constructor.
     *
     * @param UserId $id
     * @param UserFirstname $firstname
     * @param UserLastname $lastname
     * @param UserCredentials $credentials
     */
    public function __construct(
        UserId $id,
        UserFirstname $firstname,
        UserLastname $lastname,
        UserCredentials $credentials
    ) {
        $this->id = $id;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->credentials = $credentials;
    }

    /**
     * @param array $data
     *
     * @return UserCreatedEvent|null
     */
    public static function deserialize(array $data): ?UserCreatedEvent
    {
        // TODO: Implement deserialize() method.
    }

    /**
     * @return array
     */
    public function serialize(): array
    {
        return [
            'id' => $this->id->getValue(),
            'firstname' => $this->firstname->getValue(),
            'lastname' => $this->lastname->getValue(),
            'credentials' => [
                'email' => $this->credentials->getEmail()->getValue(),
                'password' => $this->credentials->getPassword()->getValue()
            ]
        ];
    }

    /**
     * @return UserId
     */
    public function getId(): UserId
    {
        return $this->id;
    }

    /**
     * @return UserFirstname
     */
    public function getFirstname(): UserFirstname
    {
        return $this->firstname;
    }

    /**
     * @return UserLastname
     */
    public function getLastname(): UserLastname
    {
        return $this->lastname;
    }

    /**
     * @return UserCredentials
     */
    public function getCredentials(): UserCredentials
    {
        return $this->credentials;
    }
}