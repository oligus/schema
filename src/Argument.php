<?php declare(strict_types=1);

namespace GQLSchema;

use GQLSchema\Values\Value;
use GQLSchema\Types\Type;

/**
 * GraphQL Argument
 *
 * Class Argument
 * @package GQLSchema
 */
class Argument
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
     * @var bool
     */
    private $nullable;

    /**
     * @var bool
     */
    private $isCollection;

    /**
     * Argument constructor.
     * @param Type $type
     * @param Value|null $defaultValue
     * @param string $name
     * @param bool $nullable
     * @param bool $isCollection
     */
    public function __construct(
        Type $type,
        ?Value $defaultValue,
        string $name = '',
        bool $nullable = true,
        bool $isCollection = false
    ) {
        $this->type = $type;
        $this->name = $name;
        $this->defaultValue = $defaultValue;
        $this->nullable = $nullable;
        $this->isCollection = $isCollection;
    }

    /**
     * @return Type
     */
    public function getType(): Type
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return Value|null
     */
    public function getDefaultValue(): ?Value
    {
        return $this->defaultValue;
    }

    /**
     * @return bool
     */
    public function isNullable(): bool
    {
        return $this->nullable;
    }

    /**
     * @return bool
     */
    public function isCollection(): bool
    {
        return $this->isCollection;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        $string = $this->getName() . ': ';

        if ($this->isCollection()) {
            $string .= '[';
        }

        $string .= $this->getType()->getName();

        if ($this->isCollection()) {
            $string .= ']';
        }

        if (!$this->isNullable()) {
            $string .= '!';
        }

        if(!is_null($this->getDefaultValue())) {
            $string .= ' = ' . $this->getDefaultValue()->__toString();
        }

        return $string;
    }
}