<?php declare(strict_types=1);

namespace GQLSchema\Values;

/**
 * Class ValueInteger
 * @package GQLSchema\Values
 */
class ValueInteger implements Value
{
    /**
     * @var integer
     */
    private $value;

    /**
     * ValueInteger constructor.
     * @param integer $value
     */
    public function __construct(int $value)
    {
        $this->value = $value;
    }

    /**
     * @return integer
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
        return "$this->value";
    }
}