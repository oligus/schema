<?php declare(strict_types=1);

namespace GQLSchema\Serializers;

use GQLSchema\Argument;
use GQLSchema\Collections\ArgumentCollection;
use GQLSchema\Types\TypeModifier;
use GQLSchema\Values\Value;
use Exception;

/**
 * Class ArgumentSerializer
 * @package GQLSchema\Serializers
 */
class ArgumentSerializer
{
    public function serialize(Argument $argument): string
    {
        $type = $argument->getType()->getName();
        $typeModifier = $argument->getTypeModifier();

        $string = $argument->getName() . ': ';

        $string .= ($typeModifier instanceof TypeModifier) ? $this->modifyType($type, $typeModifier): $type;

        $defaultValue = $argument->getDefaultValue();

        if ($defaultValue instanceof Value) {
            $string .= ' = ' . (new ValueSerializer())->serialize($defaultValue);
        }

        return $string;
    }

    private function modifyType(string $type, TypeModifier $typeModifier): string
    {
        $string = '';
        $string .= $typeModifier->isListable() ? '[' : '';
        $string .= $type;
        $string .= !$typeModifier->isNullable() ? '!' : '';
        $string .= $typeModifier->isListable() ? ']' : '';
        $string .= !$typeModifier->isNullableList() ? '!' : '';

        return $string;
    }

    /**
     * @throws Exception
     */
    public static function serializeCollection(ArgumentCollection $arguments): string
    {
        $string = '';

        if (!$arguments->isEmpty()) {
            $string .= '(';
            foreach ($arguments->getIterator() as $index => $argument) {
                $string .= (new self())->serialize($argument);

                if ($index + 2 <= $arguments->count()) {
                    $string .= ', ';
                }
            }
            $string .= ')';
        }

        return $string;
    }
}
