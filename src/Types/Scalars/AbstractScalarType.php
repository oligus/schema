<?php declare(strict_types=1);

namespace GQLSchema\Types\Scalars;

use GQLSchema\Types\Type;

/**
 * Class AbstractScalarType
 * @package GQLSchema\Types\Scalars
 */
abstract class AbstractScalarType implements Type
{
    /**
     * @var string
     */
    protected $name;

    /**
     * Returns the name.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->name;
    }

    /**
     * @return null|string
     */
    public function getDescription(): ?string
    {
        return "";
    }
}
