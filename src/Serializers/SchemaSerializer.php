<?php declare(strict_types=1);

namespace GQLSchema\Serializers;

use Doctrine\Common\Collections\Collection;
use GQLSchema\Serializers\TypeSerializers\DirectiveSerializer;
use GQLSchema\Serializers\TypeSerializers\InputSerializer;
use GQLSchema\Serializers\TypeSerializers\InterfaceSerializer;
use GQLSchema\Serializers\TypeSerializers\ScalarSerializer;
use GQLSchema\Serializers\TypeSerializers\ObjectSerializer;
use GQLSchema\Schema;
use GQLSchema\Serializers\TypeSerializers\UnionSerializer;
use GQLSchema\Exceptions\SchemaException;
use Exception;

/**
 * Class SchemaSerializer
 * @package GQLSchema\Serializers
 */
class SchemaSerializer
{
    /**
     * @param Schema $schema
     * @return string
     * @throws SchemaException
     * @throws Exception
     */
    public function serialize(Schema $schema): string
    {
        $string = '';

        if (!$schema->getDirectives()->isEmpty()) {
            $string .= $this->serializeCollection(new DirectiveSerializer(), $schema->getDirectives());
        }

        if (!$schema->getInterfaces()->isEmpty()) {
            $string .= $this->serializeCollection(new InterfaceSerializer(), $schema->getInterfaces()->getCollection());
        }

        if (!$schema->getScalars()->isEmpty()) {
            $string .= $this->serializeCollection(new ScalarSerializer(), $schema->getScalars());
        }

        if (!$schema->getUnions()->isEmpty()) {
            $string .= $this->serializeCollection(new UnionSerializer(), $schema->getUnions());
        }

        if (!$schema->getObjects()->isEmpty()) {
            $string .= $this->serializeCollection(new ObjectSerializer(), $schema->getObjects());
        }

        if (!$schema->getInputs()->isEmpty()) {
            $string .= $this->serializeCollection(new InputSerializer(), $schema->getInputs());
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

        $string .= "}\n";

        return $string;
    }

    /**
     * @param Serializer $serializer
     * @param Collection $collection
     * @return string
     * @throws Exception
     */
    private function serializeCollection(Serializer $serializer, Collection $collection): string
    {
        $string = '';

        foreach ($collection->getIterator() as $item) {
            $string .= $serializer->serialize($item);
        }

        return $string;
    }
}
