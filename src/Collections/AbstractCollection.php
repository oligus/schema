<?php declare(strict_types=1);

namespace GQLSchema\Collections;

use GQLSchema\Exceptions\SchemaException;
use Doctrine\Common\Collections\ArrayCollection;

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
     * Append an item to the list of items.
     *
     * @param InputOutput $item
     * @throws SchemaException
     */
    public function add(InputOutput $item): void
    {
        /** @var Element $collectionItem */
        foreach ($this->collection as $collectionItem) {
            if ($collectionItem->getName() === $item->getName()) {
                throw new SchemaException('The field must have a unique name within type, field name [' . $item->getName() . '] seen twice.');
            }
        }

        $this->collection->add($item);
    }
}
