<?php

namespace App\User\Application\User\Command\Create;


class CreateUserCommand
{
    /**
     * @var string
     */
    private $firstname;

    /**
     * @var string
     */
    private $lastname;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $plainPassword;

    /**
     * CreateUserCommand constructor.
     *
     * @param string $firstname
     * @param string $lastname
     * @param string $email
     * @param string $plainPassword
     */
    public function __construct(string $firstname, string $lastname, string $email, string $plainPassword)
    {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->plainPassword = $plainPassword;
    }

    /**
     * @return string
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * @return string
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPlainPassword(): string
    {
        return $this->plainPassword;
    }
}