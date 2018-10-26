<?php declare(strict_types=1);

namespace GQLSchema\Collections;

use GQLSchema\InputOutput;
use GQLSchema\Exceptions\SchemaException;
use Doctrine\Common\Collections\ArrayCollection;
use GQLSchema\Element;

/**
 * Class AbstractCollection
 * @package GQLSchema\Collections
 */
abstract class AbstractCollection
{
    /**
     * @var ArrayCollection
     */
    protected $collection;

    /**
     * FieldCollection constructor.
     */
    public function __construct()
    {
        $this->collection = new ArrayCollection();
    }

    /**
     * Returns true if empty, false otherwise.
     *
     * @return bool
     */
    public function isEmpty(): bool
    {
        return $this->collection->isEmpty();
    }

    /**
     * @return \ArrayIterator|\Traversable
     */
    public function getIterator()
    {
        return $this->collection->getIterator();
    }

    public function count()
    {
        return $this->collection->count();
    }

    /**
     * Append an item to the list of items.
     *
     * @param InputOutput $item
     * @throws SchemaException
     */
    public function add(Element $element): void
    {
        /** @var InputOutput $collectionItem */
        foreach ($this->collection as $collectionItem) {
            if ($collectionItem->getName() === $element->getName()) {
                throw new SchemaException('The field must have a unique name within type, field name [' . $element->getName() . '] seen twice.');
            }
        }

        $this->collection->add($element);
    }
}
