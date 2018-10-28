<?php declare(strict_types=1);

namespace GQLSchema\Serializers\TypeSerializers;

use GQLSchema\Field;
use GQLSchema\Types\Type;
use GQLSchema\Types\ObjectType;
use GQLSchema\Types\InterfaceType;
use GQLSchema\Exceptions\SchemaException;
use GQLSchema\Serializers\FieldSerializer;
use GQLSchema\Collections\InterfaceCollection;

/**
 * Class ObjectSerializer
 * @package GQLSchema\Serializers\TypeSerializers
 */
class ObjectSerializer
{
    /**
     * @var ObjectType
     */
    private $objectType;

    /**
     * ObjectSerializer constructor.
     * @param Type $type
     * @throws SchemaException
     */
    public function __construct(Type $type)
    {
        if (!$type instanceof ObjectType) {
            throw new SchemaException('Type must be object type');
        }

        $this->objectType = $type;
    }

    /**
     * @return string
     * @throws SchemaException
     */
    public function serialize(): string
    {
        $string = '';

        if (!empty($this->objectType->getDescription())) {
            $string .= '"""' . "\n";
            $string .= $this->objectType->getDescription() . "\n";
            $string .= '"""' . "\n";
        }

        $string .= $this->objectType->getType();
        $string .= ' ' . $this->objectType->getName();

        /** @var InterfaceCollection $interfaces */
        $interfaces = $this->objectType->getInterfaces();

        if ($interfaces instanceof InterfaceCollection && !$interfaces->isEmpty()) {
            $string .= ' implements ';

            /**
             * @var int $index
             * @var InterfaceType $interface
             */
            foreach ($this->objectType->getInterfaces()->getCollection() as $index => $interface) {
                $string .= $interface->getName();

                if ($index + 2 <= $this->objectType->getInterfaces()->getCollection()->count()) {
                    $string .= ', ';
                }
            }
        }

        $string .= " {\n";

        if ($this->objectType->getFields()->isEmpty()) {
            throw new SchemaException('An object type must define one or more fields.');
        }

        /** @var Field $field */
        foreach ($this->objectType->getFields()->getIterator() as $field) {
            $string .= '  ';
            $string .= (new FieldSerializer())->serialize($field);
            $string .= "\n";
        }

        $string .= "}\n\n";

        return $string;
    }
}
