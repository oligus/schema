<?php declare(strict_types=1);

namespace GQLSchema;

use GQLSchema\Values\Value;
use GQLSchema\Types\Type;
use GQLSchema\Exceptions\SchemaException;

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
     * @param string $name
     * @param Type $type
     * @param Value|null $defaultValue
     * @throws SchemaException
     */
    public function __construct(
        string $name,
        Type $type,
        ?Value $defaultValue = null
    ) {
        $this->setName($name);
        $this->type = $type;
        $this->defaultValue = $defaultValue;
    }

    /**
     * @param string $name
     * @throws SchemaException
     */
    private function setName(string $name): void
    {
        if (substr($name, 0, 2) === "__") {
            throw new SchemaException('The argument must not have a name which begins with the characters "__" (two underscores).');
        }


        $this->name = $name;
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
     * Returns the name.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Returns the type.
     *
     * @return Type
     */
    public function getType(): Type
    {
        return $this->type;
    }

    /**
     * Returns the default value.
     *
     * @return Value|null
     */
    public function getDefaultValue(): ?Value
    {
        return $this->defaultValue;
    }
}
