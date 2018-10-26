<?php declare(strict_types=1);

namespace GQLSchema\Serializers;

use GQLSchema\Types\TypeModifier;
use GQLSchema\Types\Type;

/**
 * Class ScalarSerializer
 * @package GQLSchema\Serializers
 */
class ScalarSerializer
{
    /**
     * @param Type $type
     * @return string
     */
    public function serialize(Type $type): string
    {
        $name = $type->getName();
        $typeModifier = $type->getTypeModifier();

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