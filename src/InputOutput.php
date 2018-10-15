<?php declare(strict_types=1);

namespace GQLSchema;

use GQLSchema\Types\Type;

/**
 * Class Field
 * @package GQLSchema
 */
interface InputOutput
{
    /**
     * String representation of this object.
     *
     * @return string
     */
    public function __toString(): string;

    /**
     * Returns the name.
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Returns the type.
     *
     * @return Type
     */
    public function getType(): Type;
}
