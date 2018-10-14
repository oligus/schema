<?php declare(strict_types=1);

namespace GQLSchema;

use Doctrine\Common\Collections\ArrayCollection;
use GQLSchema\Types\InterfaceType;

/**
 * Class Schema
 * @package GQLSchema
 */
class Schema
{
    /**
     * @var ArrayCollection
     */
    private $interfaces;

    public function __construct()
    {
        $this->interfaces = new ArrayCollection();
    }

    /**
     * @param InterfaceType $interface
     */
    public function addInterface(InterfaceType $interface): void
    {
        $this->interfaces->add($interface);
    }

    /**
     * @return string
     * @throws Exceptions\SchemaException
     */
    public function __toString(): string
    {
        $schema = '';

        /** @var InterfaceType $interface */
        foreach ($this->interfaces as $interface) {
            $schema .= $interface->__toString();
        }
        return $schema;
    }
}
