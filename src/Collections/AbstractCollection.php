<?php declare(strict_types=1);

namespace GQLSchema\Collections;

use GQLSchema\InputOutput;
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
     * @return bool
     */
    public function isEmpty(): bool
    {
        return $this->collection->isEmpty();
    }

    /**
     * @param InputOutput $item
     * @throws SchemaException
     */
    public function add(InputOutput $item): void
    {
        /** @var InputOutput $collectionItem */
        foreach ($this->collection as $collectionItem) {
            if ($collectionItem->getName() === $item->getName()) {
                throw new SchemaException('The field must have a unique name within type, field name [' . $item->getName() . '] seen twice.');
            }
        }

        $this->collection->add($item);
    }
}
