<?php declare(strict_types=1);

namespace GQLSchema\Types;

/**
 * Class TypeObject
 * @package GQLSchema\Types
 */
class TypeObject extends AbstractType
{
    /**
     * TypeObject constructor.
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }
}