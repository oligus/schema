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
     */
    public function __construct(float $value)
    {
        $this->value = $value;
    }

    public function getValue(): float
    {
        return $this->value;
    }
}
