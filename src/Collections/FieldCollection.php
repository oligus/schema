<?php declare(strict_types=1);

namespace GQLSchema\Collections;

/**
 * Class FieldCollection
 * @package GQLSchema\Collections
 */
class FieldCollection extends AbstractCollection
{
    /**
     * @return string
     */
    public function __toString(): string
    {
        if ($this->collection->isEmpty()) {
            return '';
        }

        $string = '';

        foreach ($this->collection as $index => $item) {
            $string .= '  ' . $item->__toString() . "\n";
        }

        return $string;
    }
}
