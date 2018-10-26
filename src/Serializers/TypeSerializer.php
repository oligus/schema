<?php declare(strict_types=1);

namespace GQLSchema\Serializers;

use GQLSchema\Serializers\TypeSerializers\EnumSerializer;
use GQLSchema\Serializers\TypeSerializers\InputSerializer;
use GQLSchema\Serializers\TypeSerializers\InterfaceSerializer;
use GQLSchema\Serializers\TypeSerializers\ObjectSerializer;
use GQLSchema\Serializers\TypeSerializers\UnionSerializer;
use GQLSchema\Types\InputType;
use GQLSchema\Types\InterfaceType;
use GQLSchema\Types\ObjectType;
use GQLSchema\Types\Type;
use GQLSchema\Types\EnumType;
use GQLSchema\Types\UnionType;
use GQLSchema\Exceptions\SchemaException;

/**
 * Class TypeSerializer
 * @package GQLSchema\Serializers
 */
class TypeSerializer
{
    const CONTEXT_TYPE = 'type';
    const CONTEXT_SCALAR = 'scalar';

    /**
     * @param Type $type
     * @param string $context
     * @return string
     * @throws SchemaException
     */
    public function serialize(Type $type, string $context = self::CONTEXT_TYPE): string
    {
        if($context === self::CONTEXT_SCALAR) {
            return (new ScalarSerializer())->serialize($type);
        }

        switch (true) {
            case $type instanceof EnumType:
                return (new EnumSerializer())->serialize($type);
                break;

            case $type instanceof InputType:
                return (new InputSerializer())->serialize($type);
                break;

            case $type instanceof InterfaceType:
                return (new InterfaceSerializer())->serialize($type);
                break;

            case $type instanceof ObjectType:
                return (new ObjectSerializer())->serialize($type);
                break;

            case $type instanceof UnionType:
                return (new UnionSerializer())->serialize($type);
                break;

            default:
                throw new \Exception('Unknown type: ' .$type->getName());
        }
    }


}