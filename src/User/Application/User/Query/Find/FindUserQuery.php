<?php

namespace App\User\Application\User\Query\Find;


use App\User\Domain\User\ValueObject\UserId;

class FindUserQuery
{
    /**
     * @var UserId
     */
    private $id;

    /**
     * FindByEmailQuery constructor.
     *
     * @param string $id
     */
    public function __construct(string $id)
    {
        $this->id = new UserId($id);
    }

    /**
     * @return UserId
     */
    public function getId(): UserId
    {
        return $this->id;
    }
}