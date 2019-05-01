<?php

namespace App\Shared\Domain\ValueObject;

use \DateTimeImmutable;

abstract class DateTimeValueObject
{
    private const DATETIME_FORMAT = "d/m/Y H:i:s";

    /**
     * @var DateTimeImmutable
     */
    protected $value;

    public function __construct(string $value)
    {
        $this->value = DateTimeImmutable::createFromFormat(self::DATETIME_FORMAT, $value);
    }

    /**
     * @return DateTimeImmutable
     */
    public function getValue(): DateTimeImmutable
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->value->format(self::DATETIME_FORMAT);
    }
}