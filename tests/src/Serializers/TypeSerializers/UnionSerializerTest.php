<?php declare(strict_types=1);

namespace GQLSchema\Tests\Serializers\TypeSerializers;

use GQLSchema\Serializers\TypeSerializers\UnionSerializer;
use GQLSchema\Types\Type;
use GQLSchema\Types\UnionType;
use GQLSchema\Types\ObjectType;
use GQLSchema\Types\TypeModifier;
use GQLSchema\Tests\SchemaTestCase;

/**
 * Class ValueSerializerHelp
 * @package GQLSchema\Tests\Types
 */
class TypeSerializerTest extends SchemaTestCase
{
    /**
     * @throws \GQLSchema\Exceptions\SchemaException
     */
    public function testSerialize()
    {
        $union = new UnionType('MyUnion', 'My union description');
        $union->addObjectType(new ObjectType('Dog'));

        $this->assertMatchesSnapshot((new UnionSerializer($union))->serialize());

        $union->addObjectType(new ObjectType('Cat'));
        $union->addObjectType(new ObjectType('Bird'));

        $this->assertMatchesSnapshot((new UnionSerializer($union))->serialize());
    }

    /**
     * @expectedException \GQLSchema\Exceptions\SchemaException
     * @expectedExceptionMessage No types added
     */
    public function testEmptyObjectTypes()
    {
        $union = new UnionType('MyUnion', 'My union description');
        (new UnionSerializer($union))->serialize();
    }

    /**
     * @expectedException \GQLSchema\Exceptions\SchemaException
     * @expectedExceptionMessage Type must be union type
     */
    public function testWrongType()
    {
        $mock = new class implements Type {
            public function getName(): string { return 'test'; }
            public function getType(): string { return 'testType'; }
            public function getDescription(): ?string { return null; }
            public function getTypeModifier(): ?TypeModifier { return null; }
        };

        new UnionSerializer($mock);
    }
}