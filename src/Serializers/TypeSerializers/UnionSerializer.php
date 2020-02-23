<?php declare(strict_types=1);

namespace GQLSchema\Serializers\TypeSerializers;

use GQLSchema\Serializers\Serializer;
use GQLSchema\Types\UnionType;
use GQLSchema\Types\Type;
use GQLSchema\Exceptions\SchemaException;
use Exception;

/**
 * Class UnionSerializer
 * @package GQLSchema\Serializers\TypeSerializers
 */
class UnionSerializer implements Serializer
{
    /**
     * @param Type $type
     * @return string
     * @throws SchemaException
     * @throws Exception
     */
    public function serialize(Type $type): string
    {
        if (!$type instanceof UnionType) {
            throw new SchemaException('Type must be of type UnionType');
        }

        $string = '';

        if (!empty($type->getDescription())) {
            $string .= '"""' . "\n";
            $string .= $type->getDescription() . "\n";
            $string .= '"""' . "\n";
        }

        $objectTypes = $type->getObjectTypes();

        if (empty($objectTypes)) {
            throw new SchemaException('No types added');
        }

        $string .= $type->getType();
        $string .= ' ' . $type->getName();
        $string .= ' = ' . $type->getObjectTypes();
        $string .= "\n\n";

        return $string;
    }
}
