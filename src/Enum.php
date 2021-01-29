<?php

namespace Solid\Foundation;

use ReflectionClass;
use Solid\Foundation\Exceptions\InvalidEnumValueException;
use Solid\Foundation\Traits\Arrayable;
use Solid\Foundation\Traits\Stringable;

class Enum
{
    use Stringable, Arrayable;

    /**
     * List of allowed values
     * @var array
     */
    public $allowedValues = [];

    /** @var string */
    protected $value;

    /**
     * Enumerable constructor.
     *
     * @param string $value
     * @throws \Solid\Foundation\Exceptions\InvalidEnumValueException
     */
    public function __construct(string $value)
    {
        // Fill allowed values with defined constants
        $this->allowedValues = self::options();

        if(!self::isValid($value)) {
            throw new InvalidEnumValueException($this, $value);
        }

        $this->value = $value;
    }

    /**
     * @param string $value
     * @return bool
     */
    public static function isValid(string $value): bool {
        return in_array($value, self::options(), false);
    }

    /**
     * @return array
     */
    public static function options(): array {
        return (new ReflectionClass(static::class))
            ->getConstants();
    }

    /**
     * @param string $value
     * @return static
     * @throws \Solid\Foundation\Exceptions\InvalidEnumValueException
     */
    public static function of(string $value): Enum
    {
        return new static($value);
    }

    /**
     * Check if two value are similar
     *
     * @param string $type
     * @return bool
     */
    public function is(string $type): bool {
        if($type instanceof static) {
            return $type->toString() === $this->toString();
        }

        return $type === $this->toString();
    }

    /**
     * @inheritDoc
     * @return array
     */
    public function toArray(): array
    {
        return $this->allowedValues;
    }

    /**
     * @inheritDoc
     * @return string
     */
    public function toString(): string {
        return $this->value;
    }
}