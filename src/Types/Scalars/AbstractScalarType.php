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
     * @var TypeModifier
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
        if($typeModifier instanceof TypeModifier) {
            $this->typeModifier = $typeModifier;
        }
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return TypeModifier
     */
    public function getTypeModifier(): ?TypeModifier
    {
        return $this->typeModifier;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        $name = $this->getName();

        if(is_null($this->getTypeModifier())) {
            return $name;
        }
        $string = '';

        if($this->getTypeModifier()->isListable()) {
            $string .= '[';
        }

        $string .= $name;

        if(!$this->getTypeModifier()->isNullable()) {
            $string .= '!';
        }

        if($this->getTypeModifier()->isListable()) {
            $string .= ']';
        }

        if(!$this->getTypeModifier()->isNullableList()) {
            $string .= '!';
        }

        return $string;
    }
}