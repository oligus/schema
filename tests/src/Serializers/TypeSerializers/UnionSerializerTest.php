<?php declare(strict_types=1);

namespace GQLSchema\Tests\Serializers\TypeSerializers;

use GQLSchema\Serializers\TypeSerializer;
use GQLSchema\Field;
use GQLSchema\Argument;
use GQLSchema\Serializers\TypeSerializers\UnionSerializer;
use GQLSchema\Types\EnumType;
use GQLSchema\Types\InputType;
use GQLSchema\Types\UnionType;
use GQLSchema\Types\ObjectType;
use GQLSchema\Types\TypeModifier;
use GQLSchema\Types\Scalars\BooleanType;
use GQLSchema\Types\Scalars\IntegerType;
use GQLSchema\Types\Scalars\StringType;
use GQLSchema\Values\ValueString;
use GQLSchema\Tests\SchemaTestCase;

/**
 * Class ValueSerializerHelp
 * @package GQLSchema\Tests\Types
 */
class TypeSerializerTest extends SchemaTestCase
{
    /**
     * @var TypeSerializer
     */
    private $serializer;

    protected function setUp()
    {
        $this->serializer = new UnionSerializer();
    }

    /**
     * @throws \GQLSchema\Exceptions\SchemaException
     */
    public function testSerialize()
    {
        $union = new UnionType('MyUnion', 'My union description');
        $union->addObjectType(new ObjectType('Dog'));

        $this->assertMatchesSnapshot($this->serializer->serialize($union));

        $union->addObjectType(new ObjectType('Cat'));
        $union->addObjectType(new ObjectType('Bird'));

        $this->assertMatchesSnapshot($this->serializer->serialize($union));
    }

    /**
     * @expectedException \GQLSchema\Exceptions\SchemaException
     * @expectedExceptionMessage No types added
     */
    public function testEmptyObjectTypes()
    {
        $union = new UnionType('MyUnion', 'My union description');
        $this->serializer->serialize($union);
    }

}