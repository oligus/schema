<?php declare(strict_types=1);

namespace GQLSchema\Tests\Serializers\TypeSerializers;

use GQLSchema\Exceptions\SchemaException;
use GQLSchema\Serializers\TypeSerializers\UnionSerializer;
use GQLSchema\Types\UnionType;
use GQLSchema\Types\ObjectType;
use GQLSchema\Tests\SchemaTestCase;

/**
 * Class UnionSerializerTest
 * @package GQLSchema\Tests\Serializers\TypeSerializers
 */
class UnionSerializerTest extends SchemaTestCase
{
    /**
     * @throws SchemaException
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
     * @throws SchemaException
     */
    public function testEmptyObjectTypes()
    {
        $this->expectException(SchemaException::class);
        $this->expectExceptionMessage('No types added');

        $union = new UnionType('MyUnion', 'My union description');
        (new UnionSerializer())->serialize($union);
    }
}
