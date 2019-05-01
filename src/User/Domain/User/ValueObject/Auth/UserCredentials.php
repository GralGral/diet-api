<?php

namespace App\User\Domain\User\ValueObject\Auth;


use App\User\Domain\User\ValueObject\UserEmail;

class UserCredentials
{
    /**
     * @var UserEmail
     */
    private $email;

    /**
     * TODO NEED TO BE HASHED
     *
     * @var UserPassword
     */
    private $password;

    /**
     * UserCredentials constructor.
     *
     * @param UserEmail $email
     * @param UserPassword $password
     */
    public function __construct(UserEmail $email, UserPassword $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * @return UserEmail
     */
    public function getEmail(): UserEmail
    {
        return $this->email;
    }

    /**
     * @return UserPassword
     */
    public function getPassword(): UserPassword
    {
        return $this->password;
    }
}