<?php declare(strict_types=1);

namespace GQLSchema\Collections;

/**
 * Class ArgumentCollection
 * @package GQLSchema\Collections
 */
class ArgumentCollection extends AbstractCollection
{
    /**
     * @return string
     */
    public function __toString(): string
    {
        if ($this->collection->isEmpty()) {
            return '';
        }

        $string = '(';

        foreach ($this->collection as $index => $argument) {
            $string .= $argument->__toString();

            if ($index + 2 <= count($this->collection)) {
                $string .= ', ';
            }
        }

        $string .= ')';

        return $string;
    }
}
