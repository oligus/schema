<?php declare(strict_types=1);

namespace GQLSchema\Collections;

use Doctrine\Common\Collections\ArrayCollection;
use GQLSchema\Exceptions\SchemaException;
use GQLSchema\Types\InterfaceType;

/**
 * Class InterfaceCollection
 * @package GQLSchema\Collections
 */
class InterfaceCollection
{
    /**
     * @var ArrayCollection
     */
    private $collection;

    /**
     * InterfaceCollection constructor.
     */
    public function __construct()
    {
        $this->collection = new ArrayCollection();
    }

    /**
     * Add interface to collection
     *
     * @param InterfaceType $interface
     * @throws SchemaException
     */
    public function add(InterfaceType $interface): void
    {
        /** @var InterfaceType $collectionItem */
        foreach ($this->collection as $collectionItem) {
            if ($collectionItem->getName() === $interface->getName()) {
                throw new SchemaException('The interface type must have a unique name within document, interface [' . $interface->getName() . '] seen twice.');
            }
        }

        $this->collection->add($interface);
    }

    /**
     * Get interface by name
     */
    public function get(string $name): ?InterfaceType
    {
        /** @var InterfaceType $interface */
        foreach ($this->collection as $interface) {
            if ($interface->getName() === $name) {
                return $interface;
            }
        }

        return null;
    }

    public function isEmpty(): bool
    {
        return $this->collection->isEmpty();
    }

    public function getCollection(): ArrayCollection
    {
        return $this->collection;
    }
}
