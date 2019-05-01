<?php

namespace App\Shared\Domain\ValueObject;


abstract class IntValueObject
{
    /**
     * @var int
     */
    protected $value;

    public function __construct(int $value)
    {
        $this->value = $value;
    }

    /**
     * @return int
     */
    public function getValue(): int
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