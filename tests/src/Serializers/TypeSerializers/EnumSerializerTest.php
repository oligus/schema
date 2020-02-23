<?php declare(strict_types=1);

namespace GQLSchema\Tests\Serializers\TypeSerializers;

use GQLSchema\Serializers\TypeSerializers\EnumSerializer;
use GQLSchema\Tests\SchemaTestCase;
use GQLSchema\Types\EnumType;
use GQLSchema\Exceptions\SchemaException;
use GQLSchema\Types\ObjectType;

/**
 * Class ValueSerializerHelp
 * @package GQLSchema\Tests\Types
 */
class EnumSerializerTest extends SchemaTestCase
{
    /**
     * @throws SchemaException
     */
    public function testSerialize()
    {
        $enum = new EnumType('Direction', 'Different directions', ['SOUTH', 'NORTH', 'EAST', 'WEST']);
        $serializer = new EnumSerializer();
        $this->assertMatchesSnapshot($serializer->serialize($enum));
    }

    /**
     * @throws SchemaException
     */
    public function testCorrectType()
    {
        $this->expectException(SchemaException::class);
        $this->expectExceptionMessage('Type must be of type EnumType');

        $serializer = new EnumSerializer();
        $serializer->serialize(new ObjectType('example'));
    }
}
