<?php declare(strict_types=1);

namespace GQLSchema\Tests\Serializers\TypeSerializers;

use GQLSchema\Locations\ExecutableDirectiveLocation;
use GQLSchema\Serializers\TypeSerializers\DirectiveSerializer;
use GQLSchema\Tests\SchemaTestCase;
use GQLSchema\Types\DirectiveType;
use GQLSchema\Exceptions\SchemaException;

/**
 * Class ValueSerializerHelp
 * @package GQLSchema\Tests\Types
 */
class DirectiveSerializerTest extends SchemaTestCase
{
    /**
     * @throws SchemaException
     */
    public function testSerialize()
    {
        $directive = new DirectiveType('example', 'Example directive');
        $directive->addLocation(ExecutableDirectiveLocation::FIELD());
        $directive->addLocation(ExecutableDirectiveLocation::INLINE_FRAGMENT());

        $serializer = new DirectiveSerializer();
        $this->assertMatchesSnapshot($serializer->serialize($directive));
    }
}
