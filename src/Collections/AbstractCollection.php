<?php declare(strict_types=1);

namespace GQLSchema\Collections;

use GQLSchema\Exceptions\SchemaException;
use Doctrine\Common\Collections\ArrayCollection;
use GQLSchema\Element;
use ArrayIterator;
use Exception;

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

    public function isEmpty(): bool
    {
        return $this->collection->isEmpty();
    }

    /**
     * @throws Exception
     */
    public function getIterator(): ArrayIterator
    {
        return $this->collection->getIterator();
    }

    /**
     * @throws SchemaException
     */
    public function add(Element $element): void
    {
        /** @var Element $collectionItem */
        foreach ($this->collection as $collectionItem) {
            if ($collectionItem->getName() === $element->getName()) {
                throw new SchemaException('The field must have a unique name within type, field name [' . $element->getName() . '] seen twice.');
            }
        }

        $this->collection->add($element);
    }
}
