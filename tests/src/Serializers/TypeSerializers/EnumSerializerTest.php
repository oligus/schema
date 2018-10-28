<?php declare(strict_types=1);

namespace GQLSchema\Tests\Serializers\TypeSerializers;

use GQLSchema\Serializers\TypeSerializers\EnumSerializer;
use GQLSchema\Tests\SchemaTestCase;
use GQLSchema\Types\EnumType;
use GQLSchema\Types\Type;
use GQLSchema\Types\TypeModifier;

/**
 * Class ValueSerializerHelp
 * @package GQLSchema\Tests\Types
 */
class EnumSerializerTest extends SchemaTestCase
{
    /**
     * @throws \GQLSchema\Exceptions\SchemaException
     */
    public function testSerialize()
    {
        $enum = new EnumType('Direction', 'Different directions', ['SOUTH', 'NORTH', 'EAST', 'WEST']);
        $serializer = new EnumSerializer($enum);
        $this->assertMatchesSnapshot($serializer->serialize());
    }

    /**
     * @expectedException \GQLSchema\Exceptions\SchemaException
     * @expectedExceptionMessage Type must be enum type
     */
    public function testWrongType()
    {
        $mock = new class implements Type {
            public function getName(): string { return 'test'; }
            public function getType(): string { return 'testType'; }
            public function getDescription(): ?string { return null; }
            public function getTypeModifier(): ?TypeModifier { return null; }
        };

        new EnumSerializer($mock);
    }

}