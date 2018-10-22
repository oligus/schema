<?php declare(strict_types=1);

namespace GQLSchema\Serializers;

use GQLSchema\Argument;
use GQLSchema\Types\TypeModifier;
use GQLSchema\Values\Value;

/**
 * Class ArgumentSerializer
 * @package GQLSchema\Serializers
 */
class ArgumentSerializer
{
    /**
     * @param Argument $argument
     * @return string
     */
    public function serialize(Argument $argument): string
    {
        $type = $argument->getType()->getName();
        $typeModifier = $argument->getType()->getTypeModifier();

        $string = $argument->getName() . ': ';

        if($typeModifier instanceof TypeModifier) {
            $string .= $this->modifyType($type, $typeModifier);
        } else {
            $string .= $type;
        }

        $defaultValue = $argument->getDefaultValue();

        if ($defaultValue instanceof Value) {
            $string .= ' = ' . (new ValueSerializer())->serialize($defaultValue);
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
        $string .= !$typeModifier->isNullableList() ? '!' : '';

        return $string;
    }
}