<?php declare(strict_types=1);

namespace GQLSchema\Serializers;

use GQLSchema\Serializers\TypeSerializers\InputSerializer;
use GQLSchema\Serializers\TypeSerializers\InterfaceSerializer;
use GQLSchema\Serializers\TypeSerializers\ScalarSerializer;
use GQLSchema\Serializers\TypeSerializers\ObjectSerializer;
use GQLSchema\Schema;
use GQLSchema\Serializers\TypeSerializers\UnionSerializer;

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

        if (!$schema->getInterfaces()->isEmpty()) {
            $interfaceSerializer = new InterfaceSerializer();

            foreach ($schema->getInterfaces()->getCollection()->getIterator() as $interface) {
                $string .= $interfaceSerializer->serialize($interface);
            }
        }

        if (!$schema->getScalars()->isEmpty()) {
            $scalarSerializer = new ScalarSerializer();

            foreach ($schema->getScalars()->getIterator() as $scalar) {
                $string .= $scalarSerializer->serialize($scalar);
            }
        }

        if (!$schema->getUnions()->isEmpty()) {
            $unionSerializer = new UnionSerializer();

            foreach ($schema->getUnions()->getIterator() as $union) {
                $string .= $unionSerializer->serialize($union);
            }
        }

        if (!$schema->getObjects()->isEmpty()) {
            $objectSerializer = new ObjectSerializer();

            foreach ($schema->getObjects()->getIterator() as $object) {
                $string .= $objectSerializer->serialize($object);
            }
        }

        if (!$schema->getInputs()->isEmpty()) {
            $inputSerializer = new InputSerializer();

            foreach ($schema->getInputs()->getIterator() as $input) {
                $string .= $inputSerializer->serialize($input);
            }
        }

        $string .= $this->getRootTypes($schema);

        return $string;
    }

    /**
     * @param Schema $schema
     * @return string
     */
    private function getRootTypes(Schema $schema): string
    {
        $string = "schema {\n";

        if (!empty($schema->getQuery())) {
            $string .= "  query: " . $schema->getQuery()->getName() . "\n";
        }

        if (!empty($schema->getMutation())) {
            $string .= "  mutation: " . $schema->getMutation()->getName() . "\n";
        }

        /*
        if(!empty($schema->getSubscription())) {
            $string .= "  subscription: " . $schema->getSubscription()->getName() . "\n";
        }
        */

        $string .= "}\n";

        return $string;
    }
}
