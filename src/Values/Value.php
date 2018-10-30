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
}
