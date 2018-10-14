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
     * @param Type $type
     * @param Value|null $defaultValue
     * @param string $name
     * @throws SchemaException
     */
    public function __construct(
        Type $type,
        ?Value $defaultValue,
        string $name = ''
    ) {
        $this->type = $type;
        $this->defaultValue = $defaultValue;

        $this->setName($name);
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