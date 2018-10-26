<?php declare(strict_types=1);

namespace GQLSchema\Serializers\TypeSerializers;

use GQLSchema\Field;
use GQLSchema\Types\InputType;
use GQLSchema\Types\InterfaceType;
use GQLSchema\Exceptions\SchemaException;
use GQLSchema\Serializers\FieldSerializer;
use GQLSchema\Collections\InterfaceCollection;

/**
 * Class InputSerializer
 * @package GQLSchema\Serializers\TypeSerializers
 */
class InputSerializer
{
    /**
     * @param InputType $type
     * @return string
     * @throws SchemaException
     */
    public function serialize(InputType $type): string
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
            throw new SchemaException('An input type must define one or more fields.');
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