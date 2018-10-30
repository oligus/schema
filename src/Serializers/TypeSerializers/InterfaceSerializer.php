<?php declare(strict_types=1);

namespace GQLSchema\Serializers\TypeSerializers;

use GQLSchema\Field;
use GQLSchema\Types\Type;
use GQLSchema\Types\InterfaceType;
use GQLSchema\Serializers\FieldSerializer;
use GQLSchema\Exceptions\SchemaException;

/**
 * Class InterfaceSerializer
 * @package GQLSchema\Serializers\TypeSerializers
 */
class InterfaceSerializer
{
    /**
     * @param InterfaceType $type
     * @return string
     * @throws SchemaException
     */
    public function serialize(InterfaceType $type): string
    {
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
            $string .= (new FieldSerializer())->serialize($field);
            $string .= "\n";
        }

        $string .= "}\n\n";

        return $string;
    }
}
