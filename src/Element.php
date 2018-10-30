<?php declare(strict_types=1);

namespace GQLSchema;

/**
 * Interface Element
 * @package GQLSchema
 */
interface Element
{
    /**
     * Returns the name of the type
     *
     * @return string
     */
    public function getName(): string;
}
