<?php

namespace App\User\Infrastructure\User\Persistence\Projection;


use App\Shared\Infrastructure\Persistence\Projection\Projection;
use App\User\Domain\User\ValueObject\Auth\UserCredentials;
use App\User\Domain\User\ValueObject\UserFirstname;
use App\User\Domain\User\ValueObject\UserLastname;
use App\User\Domain\User\ValueObject\UserId;

class UserProjection extends Projection
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
     * UserProjection constructor.
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
     * @return string
     */
    public function getId(): string
    {
        return (string) $this->id;
    }

    /**
     * @return mixed The object instance
     */
    public static function deserialize(array $data)
    {
        // TODO: Implement deserialize() method.
    }

    /**
     * @return array
     */
    public function serialize(): array
    {
        return [
            'id' => $this->getId(),
            'firstname' => (string) $this->firstname,
            'lastname' => (string) $this->lastname,
            'email' => (string) $this->credentials->getEmail(),
        ];
    }
}