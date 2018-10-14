<?php declare(strict_types=1);

namespace GQLSchema\Types;

/**
 * Interface Type
 * @package GQLSchema\Types
 */
interface Type
{
    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return string
     */
    public function __toString(): string;
}