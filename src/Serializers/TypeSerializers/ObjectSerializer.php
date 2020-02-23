<?php declare(strict_types=1);

namespace GQLSchema\Serializers\TypeSerializers;

use GQLSchema\Field;
use GQLSchema\Types\ObjectType;
use GQLSchema\Types\InterfaceType;
use GQLSchema\Exceptions\SchemaException;
use GQLSchema\Serializers\FieldSerializer;
use GQLSchema\Collections\InterfaceCollection;
use Exception;

/**
 * Class ObjectSerializer
 * @package GQLSchema\Serializers\TypeSerializers
 */
class ObjectSerializer
{
    /**
     * @param ObjectType $type
     * @return string
     * @throws SchemaException
     * @throws Exception
     */
    public function serialize(ObjectType $type): string
    {
        $string = '';

        if (!empty($type->getDescription())) {
            $string .= '"""' . "\n";
            $string .= $type->getDescription() . "\n";
            $string .= '"""' . "\n";
        }

        $string .= $type->getType();
        $string .= ' ' . $type->getName();

        /** @var InterfaceCollection $interfaces */
        $interfaces = $type->getInterfaces();

        if ($interfaces instanceof InterfaceCollection && !$interfaces->isEmpty()) {
            $string .= ' implements ';

            /**
             * @var int $index
             * @var InterfaceType $interface
             */
            foreach ($type->getInterfaces()->getCollection() as $index => $interface) {
                $string .= $interface->getName();

                if ($index + 2 <= $type->getInterfaces()->getCollection()->count()) {
                    $string .= ', ';
                }
            }
        }

        $string .= " {\n";

        if ($type->getFields()->isEmpty()) {
            throw new SchemaException('An object type must define one or more fields.');
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
