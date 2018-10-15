<?php declare(strict_types=1);

namespace GQLSchema\Values;

/**
 * Interface Value
 * @package GQLSchema\Values
 */
interface Value
{
    /**
     * Returns the value.
     *
     * @return mixed
     */
    public function getValue();

    /**
     * String representation of this object.
     *
     * @return string
     */
    public function __toString(): string;
}
