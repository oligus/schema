<?php declare(strict_types=1);

namespace GQLSchema\Values;

/**
 * Class ValueFloat
 * @package GQLSchema\Values
 */
class ValueFloat implements Value
{
    /**
     * @var float
     */
    private $value;

    /**
     * ValueFloat constructor.
     * @param float $value
     */
    public function __construct(float $value)
    {
        $this->value = $value;
    }

    /**
     * @return float
     */
    public function getValue(): float
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return "$this->value";
    }
}