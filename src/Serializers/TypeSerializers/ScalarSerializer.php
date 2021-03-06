<?php declare(strict_types=1);

namespace GQLSchema\Serializers\TypeSerializers;

use GQLSchema\Exceptions\SchemaException;
use GQLSchema\Serializers\Serializer;
use GQLSchema\Types\ScalarType;
use GQLSchema\Types\Type;

/**
 * Class ScalarSerializer
 * @package GQLSchema\Serializers\TypeSerializers
 */
class ScalarSerializer implements Serializer
{
    /**
     * @throws SchemaException
     */
    public function serialize(Type $type): string
    {
        if (!$type instanceof ScalarType) {
            throw new SchemaException('Type must be of type ScalarType');
        }

        $string = '';

        if (!empty($type->getDescription())) {
            $string .= '"""' . "\n";
            $string .= $type->getDescription() . "\n";
            $string .= '"""' . "\n";
        }

        $string .= $type->getType();
        $string .= ' ' . $type->getName();

        return $string . "\n\n";
    }
}
