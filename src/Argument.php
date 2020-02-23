<?php declare(strict_types=1);

namespace GQLSchema;

use GQLSchema\Types\TypeModifier;
use GQLSchema\Values\Value;
use GQLSchema\Types\Type;
use GQLSchema\Exceptions\SchemaException;

/**
 * Class Argument
 * @package GQLSchema
 */
class Argument implements Element
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
     * @var TypeModifier|null
     */
    private $typeModifier;

    /**
     * Argument constructor.
     * @param string $name
     * @param Type $type
     * @param TypeModifier|null $typeModifier
     * @param Value|null $defaultValue
     * @throws SchemaException
     */
    public function __construct(
        string $name,
        Type $type,
        ?TypeModifier $typeModifier = null,
        ?Value $defaultValue = null
    ) {
        $this->setName($name);
        $this->type = $type;
        $this->typeModifier = $typeModifier;
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

    public function getName(): string
    {
        return $this->name;
    }

    public function getType(): Type
    {
        return $this->type;
    }

    public function getDefaultValue(): ?Value
    {
        return $this->defaultValue;
    }

    public function getTypeModifier(): ?TypeModifier
    {
        return $this->typeModifier;
    }

    public function setTypeModifier(?TypeModifier $typeModifier): void
    {
        $this->typeModifier = $typeModifier;
    }
}
