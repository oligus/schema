<?php declare(strict_types=1);

namespace GQLSchema\Types\Scalars;

use GQLSchema\Types\TypeModifier;
use GQLSchema\Types\Type;

/**
 * Class AbstractScalarType
 * @package GQLSchema\Types\Scalars
 */
abstract class AbstractScalarType implements Type
{
    /**
     * @var TypeModifier|null
     */
    protected $typeModifier;

    /**
     * @var string
     */
    protected $name;

    /**
     * AbstractScalarType constructor.
     * @param TypeModifier|null $typeModifier
     */
    public function __construct(?TypeModifier $typeModifier = null)
    {
        if ($typeModifier instanceof TypeModifier) {
            $this->typeModifier = $typeModifier;
        }
    }

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
     * Returns the type modifier.
     *
     * @return TypeModifier|null
     */
    public function getTypeModifier(): ?TypeModifier
    {
        return $this->typeModifier;
    }

    /**
     * @return null|string
     */
    public function getDescription(): ?string
    {
        return "test";
    }
}
