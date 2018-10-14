<?php declare(strict_types=1);

namespace GQLSchema\Types;

/**
 * Interface Type
 * @package GQLSchema\Types
 */
interface Type
{
    /**
     * Type constructor.
     * @param TypeModifier|null $typeModifier
     * @param null|string $name
     */
    public function __construct(?TypeModifier $typeModifier, ?string $name);

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return string
     */
    public function __toString(): string;
}