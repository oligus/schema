<?php declare(strict_types=1);

namespace GQLSchema;

use Doctrine\Common\Collections\ArrayCollection;
use GQLSchema\Collections\InterfaceCollection;
use GQLSchema\Types\InterfaceType;
use GQLSchema\Types\ObjectType;

/**
 * Class Schema
 * @package GQLSchema
 */
class Schema
{
    /**
     * @var InterfaceCollection
     */
    private $interfaces;

    /**
     * Schema constructor.
     */
    /**
     * @var ArrayCollection
     */
    private $objects;

    /**
     * Schema constructor.
     */
    public function __construct()
    {
        $this->interfaces = new InterfaceCollection();
        $this->objects = new ArrayCollection();
    }

    /**
     * Adds an interface to the list of defined interfaces.
     *
     * @param InterfaceType $interface
     * @throws Exceptions\SchemaException
     */
    public function addInterface(InterfaceType $interface): void
    {
        $this->interfaces->add($interface);
    }

    /**
     * Add object to schema
     *
     * @param ObjectType $objectType
     */
    public function addObject(ObjectType $objectType): void
    {
        $this->objects->add($objectType);
    }

    /**
     * String representation of this object.
     *
     * @return string
     */
    public function __toString(): string
    {
        $schema = '';

        $schema .= $this->interfaces->__toString();

        /** @var InterfaceType $interface */
        foreach ($this->objects as $object) {
            $schema .= $object->__toString();
        }

        return $schema;
    }
}
