<?php

namespace App\Shared\Domain\ValueObject;


abstract class BooleanValueObject
{
    /**
     * @var bool
     */
    protected $value;

    public function __construct(bool $value)
    {
        $this->value = $value;
    }

    /**
     * @return bool
     */
    public function getValue(): bool
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->value ? "true" : "false";
    }
}