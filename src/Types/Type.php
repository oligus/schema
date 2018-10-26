<?php declare(strict_types=1);

namespace GQLSchema\Types;

/**
 * Interface Type
 * @package GQLSchema\Types
 */
interface Type
{
    /**
     * Returns the name of the type
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Returns the type
     *
     * @return string
     */
    public function getType(): string;

    /**
     * Returns description
     *
     * @return null|string
     */
    public function getDescription(): ?string;

    /**
     * Returns current type modifier
     *
     * @return TypeModifier|null
     */
    public function getTypeModifier(): ?TypeModifier;
}
