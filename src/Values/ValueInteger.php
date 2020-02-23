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
     */
    public function __construct(int $value)
    {
        $this->value = $value;
    }

    public function getValue(): int
    {
        return $this->value;
    }
}
