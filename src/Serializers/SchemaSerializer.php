<?php declare(strict_types=1);

namespace GQLSchema\Serializers;

use GQLSchema\Serializers\TypeSerializers\InterfaceSerializer;
use GQLSchema\Serializers\TypeSerializers\ScalarSerializer;
use GQLSchema\Types\InterfaceType;
use GQLSchema\Schema;
use GQLSchema\Types\ScalarType;

/**
 * Class SchemaSerializer
 * @package GQLSchema\Serializers
 */
class SchemaSerializer
{
    /**
     * @param Schema $schema
     * @return string
     * @throws \GQLSchema\Exceptions\SchemaException
     */
    public function serialize(Schema $schema): string
    {
        $string = '';

        if(!$schema->getInterfaces()->isEmpty()) {

            /** @var InterfaceType $interface */
            $interfaceSerializer = new InterfaceSerializer();

            foreach($schema->getInterfaces()->getCollection()->getIterator() as $interface) {
                $string .= $interfaceSerializer->serialize($interface);
            }
        }

        if(!$schema->getScalars()->isEmpty()) {
            $scalarSerializer = new ScalarSerializer();

            foreach($schema->getScalars()->getIterator() as $scalar) {
                $string .= $scalarSerializer->serialize($scalar);
            }
        }

        if(!$schema->getObjects()->isEmpty()) {
            $objectSerializer = new TypeSerializer();

            foreach($schema->getObjects()->getIterator() as $object) {
                $string .= $objectSerializer->serialize($object);
            }
        }

        return $string;

    }

}