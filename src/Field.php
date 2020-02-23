<?php declare(strict_types=1);

namespace GQLSchema;

use GQLSchema\Collections\ArgumentCollection;
use GQLSchema\Locations\SystemLocations;
use GQLSchema\Types\Type;
use GQLSchema\Exceptions\SchemaException;
use GQLSchema\Types\TypeModifier;
use GQLSchema\Locations\Location;

/**
 * Class Field
 * @package GQLSchema
 */
class Field implements Element, Location
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
     * @var ArgumentCollection
     */
    private $arguments;

    /**
     * @var string|null
     */
    private $description;

    /**
     * @var TypeModifier|null
     */
    private $typeModifier;

    /**
     * @var SystemLocations
     */
    private $location;

    /**
     * Field constructor.
     * @param string $name
     * @param Type $type
     * @param TypeModifier|null $typeModifier
     * @param null|string $description
     * @throws SchemaException
     */
    public function __construct(
        string $name,
        Type $type,
        ?TypeModifier $typeModifier = null,
        ?string $description = null
    ) {
        $this->setName($name);
        $this->type = $type;
        $this->typeModifier = $typeModifier;
        $this->description = $description;

        $this->arguments = new ArgumentCollection();
        $this->location = SystemLocations::FIELD();
    }

    /**
     * @param string $name
     * @return Field
     * @throws SchemaException
     */
    private function setName(string $name): Field
    {
        if (!preg_match('/^[_A-Za-z][_0-9A-Za-z]*/', $name)) {
            throw new SchemaException('Invalid name [' . $name . ']');
        }

        if (substr($name, 0, 2) === "__") {
            throw new SchemaException('The field must not have a name which begins with the characters "__" (two underscores).');
        }

        $this->name = $name;

        return $this;
    }

    /**
     * @param Argument $argument
     * @return Field
     * @throws SchemaException
     */
    public function addArgument(Argument $argument): Field
    {
        $this->arguments->add($argument);

        return $this;
    }

    /**
     * @return ArgumentCollection
     */
    public function getArguments(): ArgumentCollection
    {
        return $this->arguments;
    }

    /**
     * Returns the description.
     *
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Returns the name
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
     * @param TypeModifier|null $typeModifier
     * @return Field
     */
    public function setTypeModifier(?TypeModifier $typeModifier): Field
    {
        $this->typeModifier = $typeModifier;

        return $this;
    }

    /**
     * @return TypeModifier|null
     */
    public function getTypeModifier(): ?TypeModifier
    {
        return $this->typeModifier;
    }

    public function getLocation(): SystemLocations
    {
        return $this->location;
    }


}
