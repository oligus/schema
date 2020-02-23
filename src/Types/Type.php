<?php declare(strict_types=1);

namespace GQLSchema\Types;

/**
 * Interface Type
 * @package GQLSchema\Types
 */
interface Type
{
    public function getName(): string;

    public function getType(): string;

    public function getDescription(): ?string;
}
