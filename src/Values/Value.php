<?php declare(strict_types=1);

namespace GQLSchema\Values;

/**
 * Interface Value
 * @package GQLSchema\Values
 */
interface Value
{
    /**
     * @return mixed
     */
    public function getValue();

    /**
     * @return string
     */
    public function __toString(): string;
}
