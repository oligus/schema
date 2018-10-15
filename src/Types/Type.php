<?php declare(strict_types=1);

namespace GQLSchema\Types;

/**
 * Interface Type
 * @package GQLSchema\Types
 */
interface Type
{
    /**
     * Returns the name.
     *
     * @return string
     */
    public function getName(): string;

    /**
     * String representation of this object.
     *
     * @return string
     */
    public function __toString(): string;
}
