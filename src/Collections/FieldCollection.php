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
     * @param InterfaceType $interface
     * @return bool
     */
    public function implements(InterfaceType $interface): bool
    {
        /** @var Field $field */
        foreach ($this->collection as $field) {
            $match = $interface->getFields()->collection->exists(function($index, $interfaceField) use ($field) {
                /** @var Field $interfaceField */
                if($field->getName() === $interfaceField->getName()) {
                    return $field->getType()->__toString() === $interfaceField->getType()->__toString();
                }

                return false;
            });

            if($match) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        if ($this->collection->isEmpty()) {
            return '';
        }

        $string = '';

        foreach ($this->collection as $item) {
            $string .= '  ' . $item->__toString() . "\n";
        }

        return $string;
    }
}
