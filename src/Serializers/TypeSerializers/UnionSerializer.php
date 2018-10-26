<?php declare(strict_types=1);

namespace GQLSchema\Serializers\TypeSerializers;

use GQLSchema\Types\UnionType;
use GQLSchema\Exceptions\SchemaException;

/**
 * Class UnionSerializer
 * @package GQLSchema\Serializers\TypeSerializers
 */
class UnionSerializer
{
    /**
     * @param UnionType $type
     * @return string
     * @throws SchemaException
     */
    public function serialize(UnionType $type): string
    {
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

        return $string;
    }
}