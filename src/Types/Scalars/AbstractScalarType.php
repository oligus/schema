<?php declare(strict_types=1);

namespace GQLSchema\Types\Scalars;

use GQLSchema\Types\Type;
use GQLSchema\Types\TypeModifier;

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
     * AbstractType constructor.
     * @param TypeModifier|null $typeModifier
     * @param null|string $name
     */
    public function __construct(?TypeModifier $typeModifier = null, ?string $name = null)
    {
        if($typeModifier instanceof TypeModifier) {
            $this->typeModifier = $typeModifier;
        }

        if(!empty($name)) {
            $this->name = $name;
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