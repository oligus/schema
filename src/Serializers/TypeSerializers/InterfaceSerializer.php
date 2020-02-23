<?php declare(strict_types=1);

namespace GQLSchema\Serializers\TypeSerializers;

use GQLSchema\Field;
use GQLSchema\Serializers\Serializer;
use GQLSchema\Types\Type;
use GQLSchema\Types\InterfaceType;
use GQLSchema\Serializers\FieldSerializer;
use GQLSchema\Exceptions\SchemaException;
use Exception;

/**
 * Class InterfaceSerializer
 * @package GQLSchema\Serializers\TypeSerializers
 */
class InterfaceSerializer implements Serializer
{
    /**
     * @param Type $type
     * @return string
     * @throws SchemaException
     * @throws Exception
     */
    public function serialize(Type $type): string
    {
        if (!$type instanceof InterfaceType) {
            throw new SchemaException('Type must be of type InterfaceType');
        }

        $string = '';

        if (!empty($type->getDescription())) {
            $string .= '"""' . "\n";
            $string .= $type->getDescription() . "\n";
            $string .= '"""' . "\n";
        }

        $string .= $type->getType();
        $string .= ' ' . $type->getName();
        $string .= " {\n";

        if ($type->getFields()->isEmpty()) {
            throw new SchemaException('An Interface type must define one or more fields.');
        }

        /** @var Field $field */
        foreach ($type->getFields()->getIterator() as $field) {
            $string .= '  ';
            $string .= str_replace("\n", "\n  ", (new FieldSerializer())->serialize($field));
            $string .= "\n";
        }

        $string .= "}\n\n";

        return $string;
    }
}
