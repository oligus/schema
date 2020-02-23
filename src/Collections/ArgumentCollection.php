<?php declare(strict_types=1);

namespace GQLSchema\Collections;

use Doctrine\Common\Collections\ArrayCollection;
use GQLSchema\Argument;
use GQLSchema\Element;
use GQLSchema\Exceptions\SchemaException;
use GQLSchema\Serializers\ArgumentSerializer;
use Exception;

/**
 * Class ArgumentCollection
 * @package GQLSchema\Collections
 */
class ArgumentCollection extends ArrayCollection
{
    /**
     * @param mixed $argument
     * @throws SchemaException
     */
    public function add($argument): void
    {
        if (!$argument instanceof Argument) {
            throw new SchemaException('Collection item must be instance of Argument');
        }

        /** @var Element $item */
        foreach ($this->toArray() as $item) {
            if ($argument->getName() === $item->getName()) {
                throw new SchemaException('The argument must have a unique name, argument name [' . $item->getName() . '] seen twice.');
            }
        }

        parent::add($argument);
    }
}
