<?php declare(strict_types=1);

namespace GQLSchema\Collections;

use \Doctrine\Common\Collections\ArrayCollection;
use GQLSchema\Element;
use GQLSchema\Exceptions\SchemaException;

/**
 * Class CommonCollection
 */
class CommonCollection extends ArrayCollection
{
    /**
     * @param Element $element
     * @throws SchemaException
     */
    public function add($element): void
    {
        if (!$element instanceof Element) {
            throw new SchemaException('Collection item must be instance of Element');
        }

        /** @var Element $item */
        foreach ($this->toArray() as $item) {
            if ($element->getName() === $item->getName()) {
                throw new SchemaException('The field must have a unique name within type, field name [' . $item->getName() . '] seen twice.');
            }
        }

        parent::add($element);
    }
}
