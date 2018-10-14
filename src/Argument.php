<?php declare(strict_types=1);

namespace GQLSchema;

use GQLSchema\Values\Value;
use GQLSchema\Types\Type;

/**
 * Class Argument
 * @package GQLSchema
 */
class Argument implements InputOutput
{
    /**
     * @var Type
     */
    private $type;

    /**
     * @var string
     */
    private $name;

    /**
     * @var Value|null
     */
    private $defaultValue;

    /**
     * Argument constructor.
     * @param Type $type
     * @param Value|null $defaultValue
     * @param string $name
     */
    public function __construct(
        Type $type,
        ?Value $defaultValue,
        string $name = ''
    ) {
        $this->type = $type;
        $this->name = $name;
        $this->defaultValue = $defaultValue;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        $string = $this->getName() . ': ';

        $string .= $this->getType()->__toString();

        if (!is_null($this->getDefaultValue())) {
            $string .= ' = ' . $this->getDefaultValue()->__toString();
        }

        return $string;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return Type
     */
    public function getType(): Type
    {
        return $this->type;
    }

    /**
     * @return Value|null
     */
    public function getDefaultValue(): ?Value
    {
        return $this->defaultValue;
    }
}