<?php declare(strict_types=1);

namespace GQLSchema\Serializers;

use GQLSchema\Field;
use GQLSchema\Types\TypeModifier;
use Exception;

/**
 * Class FieldSerializer
 * @package GQLSchema\Serializers
 */
class FieldSerializer
{
    /**
     * @throws Exception
     */
    public function serialize(Field $field): string
    {
        $string = '';

        if (!empty($field->getDescription())) {
            $string .= '"' . $field->getDescription() . '"' . "\n";
        }

        $string .= $field->getName();

        $string .=  ArgumentSerializer::serializeCollection($field->getArguments());

        $string .= ': ' . $this->serializeScalar($field);

        return $string;
    }

    public function serializeScalar(Field $field): string
    {
        $name = $field->getType()->getName();
        $typeModifier = $field->getTypeModifier();

        return $typeModifier instanceof TypeModifier ? $this->modifyType($name, $typeModifier) : $name;
    }

    private function modifyType(string $type, TypeModifier $typeModifier): string
    {
        $string = '';
        $string .= $typeModifier->isListable() ? '[' : '';
        $string .= $type;
        $string .= !$typeModifier->isNullable() ? '!' : '';
        $string .= $typeModifier->isListable() ? ']' : '';

        if ($typeModifier->isListable()) {
            $string .= !$typeModifier->isNullableList() ? '!' : '';
        }

        return $string;
    }
}
