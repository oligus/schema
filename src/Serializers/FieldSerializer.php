<?php declare(strict_types=1);

namespace GQLSchema\Serializers;

use GQLSchema\Field;
use GQLSchema\Types\TypeModifier;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class FieldSerializer
 * @package GQLSchema\Serializers
 */
class FieldSerializer
{
    /**
     * @param Field $field
     * @return string
     */
    public function serialize(Field $field): string
    {
        $string = '';

        if (!empty($field->getDescription())) {
            $string .= '"' . $field->getDescription() . '"' . "\n";
        }

        $string .= $field->getName();

        $arguments = $field->getArguments();

        if ($arguments instanceof ArrayCollection && !$arguments->isEmpty()) {
            $string .= '(';
            foreach($arguments->getIterator() as $index => $argument) {
                $string .= (new ArgumentSerializer())->serialize($argument);

                if ($index + 2 <= $arguments->count()) {
                    $string .= ', ';
                }
            }
            $string .= ')';
        }

        $string .= ': ' . $this->serializeScalar($field);

        return $string;

    }

    public function serializeScalar(Field $field): string
    {
        $name = $field->getType()->getName();
        $typeModifier = $field->getTypeModifier();

        $string = '';

        if($typeModifier instanceof TypeModifier) {
            $string .= $this->modifyType($name, $typeModifier);
        } else {
            $string .= $name;
        }

        return $string;
    }

    /**
     * @param string $type
     * @param TypeModifier $typeModifier
     * @return string
     */
    private function modifyType(string $type, TypeModifier $typeModifier)
    {
        $string = '';
        $string .= $typeModifier->isListable() ? '[' : '';
        $string .= $type;
        $string .= !$typeModifier->isNullable() ? '!' : '';
        $string .= $typeModifier->isListable() ? ']' : '';

        if($typeModifier->isListable()) {
            $string .= !$typeModifier->isNullableList() ? '!' : '';
        }

        return $string;
    }
}