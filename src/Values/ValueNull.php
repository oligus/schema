<?php declare(strict_types=1);

namespace GQLSchema\Values;

/**
 * Class ValueNull
 * @package GQLSchema\Values
 */
class ValueNull implements Value
{
    /**
     * @return null
     */
    public function getValue()
    {
        return null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return 'null';
    }
}