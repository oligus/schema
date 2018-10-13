<?php declare(strict_types=1);

namespace GQLSchema\Types;

/**
 * Class AbstractType
 * @package GQLSchema\Types
 */
class AbstractType implements Type
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}