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
use GQLSchema\Types\Scalars\AbstractScalarType;
use GQLSchema\Types\Type;
use GQLSchema\Types\EnumType;
use GQLSchema\Types\UnionType;
use GQLSchema\Exceptions\SchemaException;
use GQLSchema\Types\TypeModifier;

/**
 * Class TypeSerializer
 * @package GQLSchema\Serializers
 */
class TypeSerializer
{
    /**
     * @param Type $type
     * @param TypeModifier|null $typeModifier
     * @return string
     * @throws SchemaException
     */
    public function serialize(Type $type, ?TypeModifier $typeModifier = null): string
    {
        if ($typeModifier instanceof TypeModifier || $type instanceof AbstractScalarType) {
            return $this->serializeScalar($type, $typeModifier);
        }

        switch (true) {
            case $type instanceof EnumType:
                return (new EnumSerializer($type))->serialize();

            case $type instanceof InputType:
                return (new InputSerializer($type))->serialize();

            case $type instanceof InterfaceType:
                return (new InterfaceSerializer($type))->serialize();

            case $type instanceof ObjectType:
                return (new ObjectSerializer($type))->serialize();

            case $type instanceof UnionType:
                return (new UnionSerializer($type))->serialize();

            default:
                throw new SchemaException('Unknown type: ' .$type->getName());
        }
    }

    /**
     * @param Type $type
     * @param TypeModifier|null $typeModifier
     * @return string
     */
    public function serializeScalar(Type $type, ?TypeModifier $typeModifier): string
    {
        $name = $type->getName();

        $string = '';

        if ($typeModifier instanceof TypeModifier) {
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

        if ($typeModifier->isListable()) {
            $string .= !$typeModifier->isNullableList() ? '!' : '';
        }

        return $string;
    }
}
