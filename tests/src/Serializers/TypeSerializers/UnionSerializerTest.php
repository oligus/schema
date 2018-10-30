<?php declare(strict_types=1);

namespace GQLSchema\Tests\Serializers\TypeSerializers;

use GQLSchema\Serializers\TypeSerializers\UnionSerializer;
use GQLSchema\Types\UnionType;
use GQLSchema\Types\ObjectType;
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

        $this->assertMatchesSnapshot((new UnionSerializer())->serialize($union));

        $union->addObjectType(new ObjectType('Cat'));
        $union->addObjectType(new ObjectType('Bird'));

        $this->assertMatchesSnapshot((new UnionSerializer())->serialize($union));
    }

    /**
     * @expectedException \GQLSchema\Exceptions\SchemaException
     * @expectedExceptionMessage No types added
     */
    public function testEmptyObjectTypes()
    {
        $union = new UnionType('MyUnion', 'My union description');
        (new UnionSerializer())->serialize($union);
    }
}