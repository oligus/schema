<?php declare(strict_types=1);

namespace GQLSchema\Collections;

use GQLSchema\Field;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class FieldCollection
 * @package GQLSchema\Collections
 */
class FieldCollection
{
    /**
     * @var ArrayCollection
     */
    private $fields;

    /**
     * FieldCollection constructor.
     */
    public function __construct()
    {
        $this->fields = new ArrayCollection();
    }

    /**
     * @param Field $field
     */
    public function add(Field $field): void
    {
        $this->fields->add($field);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        if ($this->fields->isEmpty()) {
            return '';
        }

        $string = '';

        foreach ($this->fields as $index => $argument) {
            $string .= '  ' . $argument->__toString() . "\n";
        }

        return $string;
    }
}