<?php declare(strict_types=1);

namespace GQLSchema\Values;

/**
 * Class ValueString
 * @package GQLSchema\Values
 */
class ValueString implements Value
{
    /**
     * @var string
     */
    private $value;

    /**
     * ValueString constructor.
     * @param string $value
     */
    public function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return '"' . $this->value . '"';
    }
}
