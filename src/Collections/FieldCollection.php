<?php declare(strict_types=1);

namespace GQLSchema\Collections;

use GQLSchema\Field;
use GQLSchema\Types\InterfaceType;

/**
 * Class FieldCollection
 * @package GQLSchema\Collections
 */
class FieldCollection extends AbstractCollection
{
    /**
     * Check if interface is implemented in current field collection
     *
     * @param InterfaceType $interface
     * @return bool
     */
    public function implements(InterfaceType $interface): bool
    {
        /** @var Field $interfaceField */
        foreach ($interface->getFields()->collection as $interfaceField) {
            if (!$this->hasField($interfaceField->getName())) {
                return false;
            }
        }

        return true;
    }

    /**
     * Returns true if field name is present
     *
     * @param string $name
     * @return bool
     */
    public function hasField(string $name): bool
    {
        /** @var Field $field */
        foreach ($this->collection->getIterator() as $field) {
            if ($field->getName() === $name) {
                return true;
            }
        }

        return false;
    }
}
