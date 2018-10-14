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
     * @return string
     */
    public function __toString(): string;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return Type
     */
    public function getType(): Type;
}
