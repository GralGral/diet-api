<?php

namespace App\Shared\Domain\ValueObject;


use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

abstract class Id
{
    /**
     * @var UuidInterface
     */
    protected $value;

    public function __construct(string $id = null)
    {
        $this->value = null === $id
            ? Uuid::uuid4()
            : Uuid::fromString($id);
    }

    /**
     * @return UuidInterface
     */
    public function getValue(): UuidInterface
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string) $this->value;
    }
}