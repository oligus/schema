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

    public function getName(): string
    {
        return $this->name;
    }

    public function getType(): string
    {
        return $this->name;
    }

    public function getDescription(): ?string
    {
        return "";
    }
}
